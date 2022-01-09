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
            <h1>Single Post</h1>
        </div>
    </div>

    <div class="container-fluid bg-3 text-center">

        <div class="row">

            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                @if (session()->has('success'))
                <div class="text-primary">{{session()->get('success') }}</div>
                @endif
                <p>Name: {{$post->name}}</p>
                <p>User Name: {{$post->username}}</p>
                <p>Email: {{$post->email}}</p>
                <p>Address: {{$post->address}}</p>
                <a href="{{route('posts.edit', $post)}}" class="btn btn-primary">Update</a>
                <form action="{{route('posts.destroy', $post)}}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <ul>
                    @foreach ($post->comments as $comment)

                    <li>{!!$comment->body!!}</li>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('posts.comments.edit', [$post, $comment])}}"
                            class="btn btn-secondary">Update</a>
                        <form action="{{route('posts.comments.destroy', [$post, $comment])}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        {{-- <button type="button" class="btn btn-primary">Delete</button> --}}
                    </div>

                    @endforeach
                </ul>
                <form action="{{route('posts.comments.store', $post)}}" method="post">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        {{-- <label for="exampleInputEmail1">Name</label> --}}
                        <textarea type="text" name="body" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Comment"></textarea>

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