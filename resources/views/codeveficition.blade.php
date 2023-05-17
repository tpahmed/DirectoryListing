@extends("layout")
@section('title','Verify Recovery Code')
@section('content')
    <div class="ForgotPass-Container">
        <form action="{{ route('perfom_verifyrecovery',$email) }}" method="post">
            @csrf
            <span>enter the Code sent to : <b>{{ $email }}</b></span>
            <input type="text" name="code" class="ForgotPass-Input" id="ForgotPass-Email" spellcheck="false">
            @if (count($errors))

                <div class="Flash-Error"><p>{{ $errors->first() }}</p></div>

            @endif
            <button>
                Verify
            </button>
        </form>
    </div>
@endsection
