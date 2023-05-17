
@extends("layout")
@section('title','Reset Password')
@section('content')
    <div class="ForgotPass-Container">
        <span>
            hi <b>{{ $name }}</b><br>
            here is your Password recovery code :
        </span>
        <br>
        <b>{{ $code }}</b>  <br>
        <span>code expire in <b>10 min</b> </span>
    </div>
@endsection
