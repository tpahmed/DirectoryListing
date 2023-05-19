<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    if (Auth::check()){
        return redirect('/');
    }
    return view('login');
})->name('login');

Route::post('/login', [\App\Http\Controllers\AccountController::class,'Login'])->name('perfom_login');
Route::get('/login/facebook', [\App\Http\Controllers\AccountController::class,'facebook'])->name('perfom_loginfacebook');
Route::get('/login/facebook/re', [\App\Http\Controllers\AccountController::class,'facebookRe']);
Route::get('/login/google', [\App\Http\Controllers\AccountController::class,'google'])->name('perfom_logingoogle');
Route::get('/login/google/re', [\App\Http\Controllers\AccountController::class,'googleRe']);

Route::get('/signup', function () {
    if (Auth::check()){
        return redirect('/');
    }
    return view('signup');
})->name('signup');
Route::post('/signup', [\App\Http\Controllers\AccountController::class,'SignUp'])->name('perfom_signup');



Route::post('/logout', [\App\Http\Controllers\AccountController::class,'Logout'])->name('perfom_logout');


Route::get('/forgot', function () {
    return view('forgotpass');
})->name('forgotpass');

Route::post('/forgot', [\App\Http\Controllers\AccountController::class,'ForgotPass'])->name('perfom_forgot');
Route::post('/verify/{email}', [\App\Http\Controllers\AccountController::class,'VerifyRecoveryCode'])->name('perfom_verifyrecovery');
Route::post('/verify/{email}/{code}', [\App\Http\Controllers\AccountController::class,'RecoverPass'])->name('perfom_newpasswordrecovery');

Route::get('/', function () {
    return view('home');
})->name('home');
