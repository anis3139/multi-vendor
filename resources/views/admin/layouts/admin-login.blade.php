<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/sidenav.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/datatables-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    @yield('css')

</head>
<body>


   

     @yield('content')



    <script type="text/javascript" src="{{ asset('backend/js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/sidebarmenu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/sticky-kit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/custom.min-2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/datatables-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/axios.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/custom.js') }}"></script>
    @yield('script')
</body>
</html>
