@extends('blogs.layouts.app')

@section('content')
<div class="container-fluid text-center">
    <div class="row content">

        @include('blogs.layouts.sidebar')

        <div class="col-sm-8 text-left">
            @if (session()->has('success'))
            <div class="alert alert-success">
                <strong>Success!</strong>{{session()->get('success') }}
            </div>
            @endif
            @foreach ($posts as $post)

            <div class="thumbnail">
                <div class="caption">
                    @if ($post->image)
                    <div class="position-relative">
                        <img src="{{$post->banner_path()}}" style="width: 748px;" />
                    </div>
                    @endif

                    <h4 id="thumbnail-label"><a href="{{route('posts.show',$post)}}">{{$post->title}}</a></h4>
                    <p><img src="{{$post->user->profile_path()}}" class="img-circle" alt="{{$post->user->name}}"
                            style="width: 25px;">&nbsp;
                        &nbsp;{{$post->user->name}}
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="date sub-text">{{$post->created_at->diffForHumans()}}</span>
                    </p>
                    <div class="thumbnail-description smaller">{{$post->excerpt(150)}}</div>
                </div>
                @if (auth()->id() == $post->user->id)
                <div class="caption card-footer text-center">
                    <ul class="list-inline">
                        @if(request()->query('current_user_posts') && $post->status == 0)
                        <li><a class="btn btn-default btn-sm" href="{{route('posts.edit', $post)}}">Status: Pending</a>
                        </li>
                        @endif
                        @if(request()->query('current_user_posts') && $post->status == 1)
                        <li><a class="btn btn-default btn-sm" href="{{route('posts.edit', $post)}}">Status: Publish</a>
                        </li>
                        @endif
                        <li><a class="btn btn-default btn-sm" href="{{route('posts.edit', $post)}}">Update</a></li>
                        <li><a class="btn btn-danger btn-sm" href="" onclick="event.preventDefault();
                            document.getElementById('delete-form-{{$post->id}}').submit();">Delete</a></li>
                        <form id="delete-form-{{$post->id}}" action="{{ route('posts.destroy', $post) }}" method="POST"
                            class="d-none">
                            @csrf
                            @method('delete')
                        </form>
                    </ul>
                </div>
                @endif
            </div>

            @endforeach

            {{$posts->links()}}
            {{-- <h1>Welcome</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <hr>
            <h3>Test</h3>
            <p>Lorem ipsum...</p> --}}
        </div>
        <div class="col-sm-2 sidenav">
            @auth
            <div class="well">
                <a class="btn btn-primary" href="{{route('posts.create')}}">Add New Post</a>
            </div>
            @endauth

            {{-- <div class="well">
                <p>ADS</p>
            </div> --}}
        </div>
    </div>
</div>
@endsection