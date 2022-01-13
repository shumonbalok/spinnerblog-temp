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

    @yield('styles')

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
                    <li class="{{ Route::is('posts.*') && ! Request::getQueryString()  ? 'active' : '' }}"><a
                            href="/">Home</a>
                    </li>
                    @auth
                    <li class="{{ Route::is('posts.*') && Request::query('current_user_posts')  ? 'active' : '' }}"><a
                            href="{{route('posts.index', ['current_user_posts' => auth()->id()])}}">My Posts</a></li>
                    <li
                        class="{{ Route::is('comments.*') && Request::query('current_user_comments')  ? 'active' : '' }}">
                        <a href="{{route('comments.index', ['current_user_comments' => auth()->id()])}}">My Comments</a>
                    <li class="{{ Route::is('friendships.*') && ! Request::getQueryString()  ? 'active' : '' }}">
                        <a href="{{route('friendships.index')}}">My
                            Friends</a>
                    <li class="{{ Route::is('current_user_find_friends')  ? 'active' : '' }}">
                        <a href="{{route('current_user_find_friends', ['id' => auth()->id()])}}">Find
                            Friends</a>
                    </li>
                    @endauth
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @auth
                    <li><a href="{{route('profile', ['user' => auth()->id()])}}"><img
                                src="{{auth()->user()->profile_path()}}" class="img-circle"
                                alt="{{auth()->user()->name}}" style="width: 25px;">
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

    {{-- <footer class="container-fluid text-center">
        <p>Footer Text</p>
    </footer> --}}

    <script>
        function showPassword(id) {
        var x = document.getElementById(id);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        } 
    </script>

</body>

</html>