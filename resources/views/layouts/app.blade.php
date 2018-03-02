<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">



    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/bootstrap-multiselect/bootstrap-multiselect.css')}}">
    
    <link href="{{ asset('public') . elixir('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('public/css/style.css') }}" rel="stylesheet"> --}}
    @stack('css')
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Admin Panel
                </a>
            </div>
            @if(Auth::check())
                @include("layouts.admin-menu")
            @endif
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include("layouts.flashMessage")
            </div>
        </div>
    </div>

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{ asset('public/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('public/plugins/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @stack("js")
</body>
</html>
