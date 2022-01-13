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
                <div class="btn-group btn-group-justified">
                    <a href="{{route('friendships.index')}}"
                        class="btn btn-default {{ Route::is('friendships.*') && ! Request::getQueryString()  ? 'active' : '' }}">Friends({{$allfriends_count}})</a>
                    <a href="{{route('friendships.index', ['friends' => 'pending'])}}"
                        class="btn btn-default {{ Route::is('friendships.*') && Request::query('friends') == 'pending'  ? 'active' : '' }}">Pending({{$pending_friends_count}})</a>
                    <a href="{{route('friendships.index', ['friends' => 'requests'])}}"
                        class="btn btn-default {{ Route::is('friendships.*') && Request::query('friends') == 'requests'  ? 'active' : '' }}">Friend
                        Requests({{$request_friends_count}})</a>
                </div>
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
                                <p class=""><a class="btn-link"
                                        href="{{route('profile', ['user' => $friend->id])}}">{{$friend->name}}</a></p>
                                <span class="date sub-text">{{$friend->created_at->diffForHumans()}} &nbsp; &nbsp;
                                    &nbsp;</span>
                                <span class="date sub-text">
                                    <ul class="list-inline">
                                        @if (request()->query('friends') == 'pending')
                                        <li><a class="btn btn-default btn-sm" href="#"
                                                onclick="event.preventDefault();
                                                document.getElementById('update-form-{{$friend->pivot->id}}').submit();">
                                                {{$friend->pivot->status == 0 ? 'Confirm' : 'Friend'}}</a>

                                            <form id="update-form-{{$friend->pivot->id}}"
                                                action="{{route('friendships.update', $friend->pivot->id)}}"
                                                method="post" class="d-none">
                                                @csrf
                                                @method('patch')
                                            </form>
                                        </li>
                                        @endif
                                        <li><a class="btn btn-danger btn-sm" onclick="event.preventDefault();
                                            document.getElementById('delete-form-{{$friend->id}}').submit();"
                                                href="#">Delete</a>
                                        </li>
                                        <form id="delete-form-{{$friend->id}}"
                                            action="{{route('friendships.destroy', $friend->pivot->id)}}" method="post"
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