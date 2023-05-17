@extends("layout")
@section('title','Forgot Pass')
@section('content')
    <div class="ForgotPass-Container">
        <form action="{{ route('perfom_forgot') }}" method="post">
            @csrf
            <label for="ForgotPass-Email">Email :</label>
            <input type="text" name="email" class="ForgotPass-Input" id="ForgotPass-Email" spellcheck="false">
            @if (count($errors))

                <div class="Flash-Error"><p>{{ $errors->first() }}</p></div>

            @endif
            <button>
                Send Code
            </button>
        </form>
    </div>
@endsection
