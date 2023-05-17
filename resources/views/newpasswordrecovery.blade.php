@extends("layout")
@section('title','Forgot Pass')
@section('content')
    <div class="ForgotPass-Container">
        <form action="{{ route('perfom_newpasswordrecovery',['code'=>$code,'email'=>$email]) }}" method="post">
            @csrf
            <label for="ForgotPass-Password">new Password :</label>
            <input type="password" name="password" class="ForgotPass-Input" id="ForgotPass-Password" spellcheck="false">
            <label for="ForgotPass-CPassword">Confirm new Password :</label>
            <input type="password" name="cpassword" class="ForgotPass-Input" id="ForgotPass-CPassword" spellcheck="false">
            @if (count($errors))

                <div class="Flash-Error"><p>{{ $errors->first() }}</p></div>

            @endif
            <button>
                Change Password
            </button>
        </form>
    </div>
@endsection
