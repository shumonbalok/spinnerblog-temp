@extends('blogs.layouts.app')

@section('content')
<div class="container-fluid text-center">
    <div class="row content">

        @include('blogs.layouts.sidebar')

        <div class="col-sm-8 text-left">
            @if (session()->has('success'))
            <div class="alert alert-success">
                <strong>Success!</strong> {{session()->get('success') }}
            </div>
            @endif
            @if (session()->has('warning'))
            <div class="alert alert-warning">
                <strong>Warning!</strong> {{session()->get('warning') }}
            </div>
            @endif

            <div class="thumbnail">
                <div class="caption">
                    @if ($post->image)
                    <div class="position-relative">
                        <img src="{{$post->banner_path()}}" style="max-width: 748px;" />
                    </div>
                    @endif

                    <h4 id="thumbnail-label"><a href="{{route('posts.show',$post)}}">{{$post->title}}</a></h4>
                    <p><img src="{{$post->user->profile_path()}}" class="img-circle" alt="{{$post->user->name}}"
                            style="width: 25px;">&nbsp;
                        &nbsp;{{$post->user->name}}
                    </p>
                    <div class="thumbnail-description smaller">{{$post->description}}</div>
                </div>
                @if (auth()->id() == $post->user->id)
                <div class="caption card-footer text-center">
                    <ul class="list-inline">
                        <li><a class="btn btn-default btn-sm" href="{{route('posts.edit', $post)}}">Update</a></li>
                        <li><a class="btn btn-danger btn-sm" href="" onclick="event.preventDefault();
                            document.getElementById('delete-form').submit();">Delete</a></li>
                        <form id="delete-form" action="{{ route('posts.destroy', $post) }}" method="POST"
                            class="d-none">
                            @csrf
                            @method('delete')
                        </form>

                    </ul>
                </div>
                @endif

                <div class="caption card-footer text-right">
                    <ul class="list-inline">
                        <li><a class="btn btn-default btn-sm" onclick="event.preventDefault();
                            document.getElementById('vote-form').submit();"><span
                                    class="glyphicon glyphicon-thumbs-up"></span> Like</a></li>
                        <li>{{$post->votes->count()}} {{$post->votes->count() > 1 ? 'Likes' :
                            'Like'}}</li>
                        <form id="vote-form" action="{{route('posts.vote', $post)}}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>

            </div>

            <div class="detailBox">
                <div class="titleBox">
                    <label>{{$post->comments->where('status', 1)->count() > 1 ? 'Comments' :
                        'Comment'}} ({{$post->comments->where('status', 1)->count()}})</label>
                </div>
                {{-- <div class="commentBox">

                    <p class="taskDescription">Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry.</p>
                </div> --}}
                <div class="actionBox">
                    <ul class="commentList">
                        @foreach ($post->comments->where('status', 1) as $comment)
                        <li>
                            <div class="commenterImage">
                                <img src="{{$comment->user->profile_path()}}" />
                            </div>
                            <div class="commentText">
                                @if (!$comment->image)
                                <p class="">{{$comment->body}}</p>
                                @else
                                <p class=""><img style="max-height: 150px;" src="{{$comment->image_path()}}" />
                                </p>
                                @endif
                                <span class="date sub-text">{{$comment->created_at->diffForHumans()}}</span>
                                <span class="date sub-text">
                                    <ul class="list-inline">
                                        <li><a class="btn btn-default btn-sm" onclick="event.preventDefault();
                                            document.getElementById('vote-comment-form-{{$comment->id}}').submit();"
                                                href="#"><span class="glyphicon glyphicon-thumbs-up"></span> Like</a>
                                        </li>
                                        <li>{{$comment->votes->count()}} {{$comment->votes->count() > 1 ? 'Likes' :
                                            'Like'}}</li>
                                        @if (auth()->check() && auth()->id() == $comment->user_id)
                                        <li><a class="btn btn-default btn-sm"
                                                href="{{route('comments.edit', $comment)}}"> Update</a>
                                        </li>
                                        <li><a class="btn btn-danger btn-sm" onclick="event.preventDefault();
                                            document.getElementById('update-comment-form-{{$comment->id}}').submit();"
                                                href="#">Delete</a>
                                        </li>
                                        <form id="update-comment-form-{{$comment->id}}"
                                            action="{{route('comments.destroy', $comment)}}" method="post"
                                            class="d-none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        @endif
                                        <form id="vote-comment-form-{{$comment->id}}"
                                            action="{{route('comments.vote', $comment)}}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </span>

                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <form class="form-inline form" role="form"
                        action="{{route('comments.store', ['post_id' => $post->id])}}" method="POST"
                        enctype="multipart/form-data">
                        <div class="form-group @error('body') has-error has-feedback @enderror">
                            <span class="input-group-addon" id="comment-addon" onclick="event.preventDefault();
                            document.getElementById('comment-image').click();">
                                <i class=" glyphicon glyphicon-picture"></i></span>
                            <input class="form-control" id="comment-body" name="body" type="text"
                                placeholder="Your comments" />
                            <input class="form-control" type="file" id="comment-image" name="image"
                                style="display: none" onchange="document.getElementById('comment-image').style.display = 'block';
                                    document.getElementById('comment-body').remove();
                                    document.getElementById('comment-addon').style.display = 'none';
                            ">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Add</button>
                        </div>

                        @error('body')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                        @csrf
                    </form>
                </div>
            </div>

        </div>
        <div class="col-sm-2 sidenav">


            {{-- <div class="well">
                <p>ADS</p>
            </div> --}}
        </div>
    </div>
</div>
@endsection