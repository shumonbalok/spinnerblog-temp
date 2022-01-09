<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Spinner Blog Test') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .detailBox {
            border: 1px solid #bbb;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .titleBox {
            background-color: #fdfdfd;
            padding: 10px;
        }

        .titleBox label {
            color: #444;
            margin: 0;
            display: inline-block;
        }

        .commentBox {
            padding: 10px;
            border-top: 1px dotted #bbb;
        }

        .commentBox .form-group:first-child,
        .actionBox .form-group:first-child {
            width: 80%;
        }

        .commentBox .form-group:nth-child(2),
        .actionBox .form-group:nth-child(2) {
            width: 18%;
        }

        .actionBox .form-group * {
            width: 93%;
            display: inline;
            margin-left: -5px;
        }

        .input-group-addon {
            padding: 9px 12px;
            margin-left: 1px !important;
        }

        .taskDescription {
            margin-top: 10px 0;
        }

        .commentList {
            padding: 0;
            list-style: none;
            overflow: auto;
        }

        .commentList li {
            margin: 0;
            margin-top: 10px;
        }

        .commentList li>div {
            display: table-cell;
        }

        .commenterImage {
            width: 30px;
            margin-right: 5px;
            height: 100%;
            float: left;
        }

        .commenterImage img {
            width: 100%;
            border-radius: 50%;
        }

        .commentText p {
            margin: 0;
        }

        .sub-text {
            color: #aaa;
            font-family: verdana;
            font-size: 11px;
        }

        .sub-text .list-inline {
            display: inline;
        }

        .sub-text .list-inline .btn {
            padding: 1px 5px;
            font-size: 10px;
        }

        .actionBox {
            border-top: 1px dotted #bbb;
            padding: 10px;
        }

        .taxt-center {
            text-align: center;
        }

        .thumbnail {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
            transition: 0.3s;
            min-width: 40%;
            border-radius: 5px;
        }

        .thumbnail-description {
            min-height: 40px;
        }

        .thumbnail:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 1);
        }

        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 450px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Logo</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Projects</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @auth
                    <li><a href="#"><img
                                src="{{is_null(auth()->user()->image) ? null : asset('storage/'.auth()->user()->image->image)}}"
                                class="img-circle" alt="{{auth()->user()->name}}" style="width: 25px;">
                            {{auth()->user()->name}}</a>
                    </li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><span
                                class="glyphicon glyphicon-log-out"></span> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @else
                    @if (Route::has('login'))
                    <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    @endif
                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-log-in"></span> Register</a>
                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="container-fluid text-center">
        <p>Footer Text</p>
    </footer>

</body>

</html>