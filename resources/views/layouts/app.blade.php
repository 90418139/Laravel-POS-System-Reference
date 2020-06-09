<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- fontawesome --}}
    <link href="/fontawesome/css/all.css" rel="stylesheet">
    <script defer src="/fontawesome/js/all.js"></script>

    {{-- Styles --}}
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    {{-- DataTables --}}
    <link rel="stylesheet" type="text/css" href="/DataTables-1.10.21/css/dataTables.bootstrap4.min.css"/>

</head>
<body style="overflow: hidden">
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
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Order<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/">
                                    Master
                                </a>
                                <a class="dropdown-item" href="/make">
                                    slave
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                item<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/merchandise/create">
                                    建立商品
                                </a>
                                <a class="dropdown-item" href="/merchandise/manage">
                                    管理商品
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Staff : {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

<script src="/js/jquery-3.3.1.slim.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
{{-- DataTables --}}
<script type="text/javascript" src="/DataTables-1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/DataTables-1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.order_item').click(function (event) {
            event.preventDefault();
            var item = $(this).find('span').eq(0).text();
            var price = $(this).find('span').eq(1).text();
            var qty = prompt('Enter Qty');
            price = price * qty;
            var td = "<tr><td>" + item + "</td><td>" + qty + "</td><td>" + price + "</td></tr>";
            $('#right_table_body').append(td);
            sum_total();
            set_input();
            $('#input_user').val($('#table_num').text());

        });
        $('.order_table').click(function (event) {
            event.preventDefault();
            var table = $(this).find('span').eq(0).text();
            $('#table_num').html(table);
            $('#table_menu').hide();
            $('#item_menu').show();
            $('#input_user').val(table);
        });
        $('#item_menu').hide();
        $('.myTable').DataTable({
            'iDisplayLength': 3,
            'bFilter': false,
            "bInfo": false,
            "bLengthChange": false,
            "bSort": false,
        });
    });
    $(document).ready( function () {

    } );
    function sum_total() {
        tbody = document.getElementById('right_table_body');
        total_cost = 0
        for(i = 0; i < tbody.rows.length; i++){
            total_cost += parseInt(tbody.rows[i].cells[2].innerHTML);
        }
        total = document.getElementById('total');
        total.innerHTML = total_cost;
    }
    function set_input() {
        var item = '';
        var qty ='';
        var price = '';
        tbody = document.getElementById('right_table_body');
        for(i = 0; i < tbody.rows.length; i++){
            item += tbody.rows[i].cells[0].innerHTML + ',';
            qty += tbody.rows[i].cells[1].innerHTML + ',';
            price += tbody.rows[i].cells[2].innerHTML + ',';
        }
        $('#input_item').val(item);
        $('#input_qty').val(qty);
        $('#input_price').val(price);
    }
</script>
<script type="text/javascript">
    function item_delete(event) {
        td = event.target;
        td.parentNode.remove();
        sum_total();
        set_input();
    }
</script>
</body>
</html>
