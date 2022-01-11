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
                    <label>{{$friends->count() > 1 ? 'Friends' :
                        'Friend'}} ({{$friends->count()}})</label>
                </div>
                <div class="actionBox">
                    <ul class="commentList">
                        @foreach ($friends as $friend)
                        <li>
                            <div class="commenterImage">
                                <img src="{{$friend->profile_path()}}" />
                            </div>
                            <div class="commentText">
                                <p class="">{{$friend->name}}</p>
                                <span class="date sub-text">{{$friend->created_at->diffForHumans()}}</span>
                                <span class="date sub-text">
                                    <ul class="list-inline">
                                        <li><a class="btn btn-default btn-sm"
                                                href="{{route('friendships.edit', $friend)}}">Update</a>
                                        </li>
                                        <li><a class="btn btn-danger btn-sm" onclick="event.preventDefault();
                                            document.getElementById('update-comment-form-{{$friend->id}}').submit();"
                                                href="#">Unfriend</a>
                                        </li>
                                        <form id="update-comment-form-{{$friend->id}}"
                                            action="{{route('friendships.destroy', $friend)}}" method="post"
                                            class="d-none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </ul>
                                </span>

                            </div>
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>

        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection