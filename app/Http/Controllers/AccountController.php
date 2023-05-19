<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginReq;
use App\Http\Requests\RecoverPassReq;
use App\Http\Requests\SignupReq;
use App\Mail\ForgotPassMail;
use App\Models\Account;
use App\Models\PassRecovery;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class AccountController extends Controller
{
    public function Login(LoginReq $req){
        $req->validated();
        $AccsWithSameEmail = Account::where('email','=',$req->input('email'))->get();

        if (!count($AccsWithSameEmail)){
            return back()->withErrors(['msg'=>"Account Doesn't  exists"]);
        }
        if(!Hash::check($req->input('password'),$AccsWithSameEmail->first()->password)){
            return back()->withErrors(['msg'=>"Password incorrect"]);
        }
        auth()->login($AccsWithSameEmail->first());
        return redirect('/');
    }

    public function SignUp(SignupReq $req){
        $req->validated();
        $AccsWithSameEmail = Account::where('email','=',$req->input('email'))->get();
        if (count($AccsWithSameEmail)){
            return back()->withErrors(['msg'=>'Email Already exists']);
        }
        $acc = new Account();
        $acc->name = $req->input('username');
        $acc->email = $req->input('email');
        $acc->password = $req->input('password');
        $acc->save();
        auth()->login($acc);
        return redirect('/');
    }

    public function Logout(){
        auth()->logout();
        return redirect('/login');
    }
    public function ForgotPass(Request $req){
        $AccsWithSameEmail = Account::where('email','=',$req->input('email'))->get();
        if (!count($AccsWithSameEmail)){
            return back()->withErrors(['msg'=>'Email Not Valid']);
        }
        $verification_code = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
        Mail::to($AccsWithSameEmail->first()->email)->send(new ForgotPassMail("$verification_code",$AccsWithSameEmail->first()->name));
        $PassRecoveryInst = new PassRecovery();
        $PassRecoveryInst->code = $verification_code;
        $PassRecoveryInst->used = false;
        $PassRecoveryInst->account_id = $AccsWithSameEmail->first()->id;
        $PassRecoveryInst->save();

        return view('codeveficition',['email'=>$req->input('email')]);
    }
    public function VerifyRecoveryCode(Request $req,$email){
        $AccsWithSameEmail = Account::where('email','=',$email)->get();
        if (!count($AccsWithSameEmail)){
            return back()->withErrors(['msg'=>'Internal error please try later']);
        }
        $PassRecoveryInst = $AccsWithSameEmail->first()->PassRecoveries->last();
        if($PassRecoveryInst->used){
            return back()->withErrors(['msg'=>'No Code Requested']);
        }
        $curtime = time();
        if(((strtotime($PassRecoveryInst->created_at)-$curtime) - 600) >= 0 ){
            return back()->withErrors(['msg'=>'Code expired']);
        }
        if(!Hash::check($req->input('code'),$PassRecoveryInst->code)){
            return view('codeveficition',['email'=>$email,'errors'=>['msg'=>'Code Invalid']]);
        }

        return view('newpasswordrecovery',['email'=>$email,'code'=>$req->input('code')]);
    }
    public function RecoverPass(RecoverPassReq $req,$email,$code){
        $AccsWithSameEmail = Account::where('email','=',$email)->get();
        if (!count($AccsWithSameEmail)){
            return back()->withErrors(['msg'=>'Internal error please try later']);
        }
        $PassRecoveryInst = $AccsWithSameEmail->first()->PassRecoveries->last();
        if($PassRecoveryInst->used){
            return back()->withErrors(['msg'=>'No Code Requested']);
        }
        $curtime = time();
        if(((strtotime($PassRecoveryInst->created_at)-$curtime) - 600) >= 0 ){
            return back()->withErrors(['msg'=>'Code expired']);
        }
        if(!Hash::check($code,$PassRecoveryInst->code)){
            return view('codeveficition',['email'=>$email,'errors'=>['msg'=>'Code Invalid']]);
        }
        $PassRecoveryInst->used = true;
        $PassRecoveryInst->save();
        $req->validated();
        $AccsWithSameEmail->first()->password = $req->input('password');
        $AccsWithSameEmail->first()->save();
        auth()->login($AccsWithSameEmail->first());

        return redirect('/');
    }

    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookRe()
    {
        $acc = Socialite::driver('facebook')->user();
        $current_Acc = Account::updateOrCreate(['name'=>$acc->name,'email'=>$acc->email,'facebook_id'=>$acc->id]);
        auth()->login($current_Acc);
        return redirect('/');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleRe()
    {
        $acc = Socialite::driver('google')->user();
        $AccsWithSameEmail = Account::where('email','=',$acc->email)->get();
        if(count($AccsWithSameEmail)){
            $AccsWithSameEmail->first()->google_id = $acc->id;
            $AccsWithSameEmail->first()->save();
            auth()->login($AccsWithSameEmail->first());

            return redirect('/');
        }
        $current_Acc = Account::create(['name'=>$acc->name,'email'=>$acc->email,'google_id'=>$acc->id]);
        auth()->login($current_Acc);
        return redirect('/');
    }

}
