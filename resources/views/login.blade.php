@extends("layout")
@section('title','Log in')
@section('content')
    <div class="Login-Container">
        <form action="{{ route('perfom_login') }}" method="post">
            @csrf
            <label for="Login-Email">Email :</label>
            <input type="text" name="email" class="Login-Input" id="Login-Email" spellcheck="false">
            <label for="Login-Pass">PassWord :</label>
            <input type="password" name="password" class="Login-Input" id="Login-Pass" spellcheck="false">
            <div onclick="window.location=`{{ route('forgotpass') }}`" id="Login-forgotpass">Forgot My PassWord</div>
            @if (count($errors))

            <div class="Flash-Error"><p>{{ $errors->first() }}</p></div>

            @endif
            <button>
                Login
            </button>
            <div onclick="window.location=`{{ route('signup') }}`">create an account</div>
        </form>
        <div class="Login-Separator">
            <hr>
            <span>OR</span>
            <hr>
        </div>
        <div class="Login-Altrenatives">
            {{-- <div id="Login-FaceBook" onclick="window.location=`{{ route('perfom_loginfacebook') }}`"> <img src="{{ asset('icons/facebook.svg') }}" alt="FaceBook" width="40px"> <span>Connect With FaceBook</span> </div> --}}
            <div id="Login-Google" onclick="window.location=`{{ route('perfom_logingoogle') }}`"> <img src="{{ asset('icons/google.svg') }}" alt="Google" width="40px"> <span>Connect With Google</span> </div>
            {{-- <div id="Login-Apple" onclick="window.location=`{{ route('perfom_logingoogle') }}`"> <img src="{{ asset('icons/apple.svg') }}" alt="Apple" width="40px"> <span>Connect With Apple</span> </div> --}}
        </div>
    </div>
@endsection
