@extends("layout")
@section('title','Home')
@section('content')
    <div class="Home-Container">
        @if (Auth::check())
            {{ Auth::user()->name }}
            <form action="{{ route('perfom_logout') }}" method="post">
                @csrf
                <button>Logout</button>
            </form>
        @else
            not logged in
            <button onclick="window.location=`{{ route('login') }}`">Login</button>
            <button onclick="window.location=`{{ route('signup') }}`">Signup</button>
        @endif
    </div>
@endsection
