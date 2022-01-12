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

            <div class="detailBox m-t-30">

                <div class="titleBox">
                    {{-- <label>{{count($friends) > 1 ? 'Friends' :
                        'Friend'}} ({{count($friends)}})</label> --}}
                </div>
                <div class="actionBox">
                    <ul class="commentList">
                        @foreach ($friends as $friend)
                        <li>
                            <div class="commenterImage">
                                <img src="{{$friend->profile_path()}}" />
                            </div>
                            <div class="commentText">
                                <p class="">{{$friend->name . $friend->id}}</p>
                                <span class="date sub-text">{{$friend->created_at->diffForHumans()}} &nbsp;
                                    &nbsp;</span>
                                <span class="date sub-text">
                                    <ul class="list-inline">
                                        <li><a class="btn btn-primary btn-sm" onclick="event.preventDefault();
                                            document.getElementById('form-{{$friend->id}}').submit();" href="#">Send
                                                friend request</a>
                                        </li>
                                        <form id="form-{{$friend->id}}" action="{{route('current_user_find_friends')}}"
                                            method="post" class="d-none">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="friend_id" value="{{$friend->id}}">
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