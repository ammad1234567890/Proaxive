<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@">
    <meta name="twitter:creator" content="@">
    <meta name="twitter:card" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">

    <!-- Facebook -->
    <meta property="og:url" content=" ">
    <meta property="og:title" content=" ">
    <meta property="og:description" content=" ">

    <meta property="og:image" content=" ">
    <meta property="og:image:secure_url" content=" ">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content=" ">
    <meta name="author" content=" ">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('img/proaxive-x.ico')}}" rel="shortcut icon" type="icon/proaxive-x" sizes="16x16">

    <!-- vendor css -->
    <link href="{{ asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{ asset('lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">

    <!-- Amanda CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">


    <main>
        @yield('content')
    </main>
</div>

<script src="{{ asset('lib/jquery/jquery.js')}}"></script>
<script src="{{ asset('lib/popper.js/popper.js')}}"></script>
<script src="{{ asset('lib/bootstrap/bootstrap.js')}}"></script>
<script src="{{ asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>


</body>
</html>
