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

            <div class="detailBox">
                <div class="titleBox">
                    {{-- <label>{{$comment_with_posts->count() > 1 ? 'Comments' :
                        'Comment'}} ({{$comment_with_posts->count()}})</label> --}}
                </div>
                <div class="actionBox">
                    @foreach ($comment_with_posts as $title => $posts)
                    <ul class="commentList">
                        <li>
                            <h2 style="font-size: 20px; color: gray;"><a
                                    href="{{route('posts.show', $posts[0]['post']['id'])}}"
                                    class="btn-link">{{$title}}</a></h2>
                        </li>
                        @foreach ($posts as $comment)
                        <li style="margin-left: 20px">
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
                                <span class="date sub-text">{{$comment->created_at->diffForHumans()}} &nbsp; &nbsp;
                                    &nbsp;</span>
                                <span class="date sub-text">
                                    <ul class="list-inline">
                                        <li>{{$comment->votes->count()}} {{$comment->votes->count() > 1 ? 'Likes' :
                                            'Like'}}</li>
                                        @if (auth()->check() && auth()->id() == $comment->user_id)

                                        @if(request()->query('current_user_comments') && $comment->status == 1)
                                        <li><a class="btn btn-default btn-sm"
                                                href="{{route('comments.edit', $comment)}}">Status: Publish</a>
                                        </li>
                                        @endif
                                        @if(request()->query('current_user_comments') && $comment->status == 0)
                                        <li><a class="btn btn-default btn-sm"
                                                href="{{route('comments.edit', $comment)}}">Status: Pending</a>
                                        </li>
                                        @endif

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
                                    </ul>
                                </span>

                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endforeach

                </div>
            </div>

        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection