<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - {{ $title }}</title>

    {{-- fontawesome --}}
    <link href="/fontawesome/css/all.css" rel="stylesheet">
    <script defer src="/fontawesome/js/all.js"></script>

    {{-- Bootstrap --}}
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    {{-- myStyles --}}
    <link href="/css/style.css" rel="stylesheet">

    @if($title == 'Order')
        {{-- DataTables --}}
        <link rel="stylesheet" type="text/css" href="/DataTables-1.10.21/css/dataTables.bootstrap4.min.css"/>
    @endif
    @if($title == 'Dashboard')
        {{-- Chart.js --}}
        <link rel="stylesheet" type="text/css" href="/Chart/Chart.min.css"/>
    @endif
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-key"></i>{{ trans('pos.login.login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ trans('pos.login.register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-solar-panel"></i>Order<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/">
                                    Master
                                </a>
                                <a class="dropdown-item" href="/make">
                                    Slave
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fab fa-product-hunt"></i>Product<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/merchandise/create">
                                    Create
                                </a>
                                <a class="dropdown-item" href="/merchandise/manage">
                                    Manage
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-user"></i>{{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/dashboard">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>


                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</div>
{{-- Bootstrap --}}
<script src="/js/jquery-3.3.1.slim.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
@if($title == 'Order')
    {{-- DataTables --}}
    <script type="text/javascript" src="/DataTables-1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/DataTables-1.10.21/js/dataTables.bootstrap4.min.js"></script>
@endif
@if($title == 'Dashboard')
    {{-- Chart.js --}}
    <script type="text/javascript" src="/Chart/Chart.min.js"></script>
@endif
{{-- myScript --}}
<script type="text/javascript" src="/js/script.js"></script>
</body>
</html>
