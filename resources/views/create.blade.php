<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Add a gray background color and some padding to the footer */
        footer {
            background-color: #f2f2f2;
            padding: 25px;
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
                <a class="navbar-brand" href="#">Portfolio</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="jumbotron">
        <div class="container text-center">
            <h1>Create Post</h1>
        </div>
    </div>

    <div class="container-fluid bg-3 text-center">
        {{-- <h3>Some of my Work</h3><br> --}}
        <ul>

            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>

            @endforeach

            @endif

        </ul>
        <div class="row">

            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                <form action="{{route('posts.store')}}" method="post">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">User Name</label>
                        <input type="text" value="{{old('username')}}" name="username" class="form-control"
                            id="exampleInputPassword1" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" value="{{old('email')}}" name="email" class="form-control"
                            id="exampleInputPassword1" placeholder="Email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Address</label>
                        <input type="text" value="{{old('address')}}" name="address" class="form-control"
                            id="exampleInputPassword1" placeholder="Address">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div><br>


    <footer class="container-fluid text-center">
        <p>Footer Text</p>
    </footer>

</body>

</html>