@extends("layout")
@section('title','Sign Up')
@section('content')
    <div class="SignUp-Container">
        <form action="{{ route('perfom_signup') }}" method="post">
            @csrf
            <label for="SignUp-Username">Username :</label>
            <input type="text" name="username" class="SignUp-Input" id="SignUp-Username" spellcheck="false">
            <label for="SignUp-Email">Email :</label>
            <input type="text" name="email" class="SignUp-Input" id="SignUp-Email" spellcheck="false">
            <label for="SignUp-Pass">PassWord :</label>
            <input type="password" name="password" class="SignUp-Input" id="SignUp-Pass" spellcheck="false">
            @if (count($errors))

            <div class="Flash-Error"><p>{{ $errors->first() }}</p></div>

            @endif
            <button>
                SignUp
            </button>
            <div onclick="window.location=`{{ route('login') }}`">I have an account</div>
        </form>
        <div class="Login-Separator">
            <hr>
            <span>OR</span>
            <hr>
        </div>
        <div class="Login-Altrenatives">
            <div id="Login-FaceBook"> <img src="{{ asset('icons/facebook.svg') }}" alt="FaceBook" width="40px"> <span>Connect With FaceBook</span> </div>
            <div id="Login-Google"> <img src="{{ asset('icons/google.svg') }}" alt="Google" width="40px"> <span>Connect With Google</span> </div>
            <div id="Login-Apple"> <img src="{{ asset('icons/apple.svg') }}" alt="Apple" width="40px"> <span>Connect With Apple</span> </div>
        </div>
    </div>
@endsection
