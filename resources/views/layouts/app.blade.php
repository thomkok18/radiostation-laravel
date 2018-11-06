<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Radiostation') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
</head>
<body>
@include('includes.navbar')
@include('includes.messages')
<div id="container">
    <div id="body">
        @yield('content')
    </div>
</div>
<footer id="footer">
    <div class="container">
        Copyright ©
        <div class="row">
            <a class="col-xs-12 col-md-12" href="/">Home</a>
            <a class="col-xs-12 col-md-12" href="/programma">Programma aanmaken</a>
            <a class="col-xs-12 col-md-12" href="/liedjes">Liedje aanmaken</a>
        </div>
    </div>
</footer>
</body>
</html>
