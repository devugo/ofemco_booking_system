<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ofemco Services') }} | {{ $pageTitle }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    @include('includes.top')
    @yield('css')
</head>
<body>
    <div id="app">
        @include('layouts/header')

        {!! alertBox() !!}
        
        @yield('content')
        @include('includes.newsletter')

        @include('includes.footer-content')
    
        @include('includes.copyright')
    </div>
</body>
    @include('includes.bottom')
    @yield('javascript')
</html>
