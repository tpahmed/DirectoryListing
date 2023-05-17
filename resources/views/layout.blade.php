
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
        <link rel="stylesheet" href="{{ asset('css/forgotpass.css') }}">
        <style type="text/css">
            @font-face {
                font-family: 'SimplyMono';
                src: url('{{ asset('fonts/SimplyMono.ttf') }}');
            }
            @font-face {
                font-family: 'Sono';
                src: url('{{ asset('fonts/Sono.ttf') }}');
            }
        </style>

    </head>
    <body class="antialiased">
        @yield("content")
    </body>
</html>
