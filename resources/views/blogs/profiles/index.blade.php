@extends('blogs.layouts.app')

@section('content')
<div class="container-fluid text-center">
    <div class="row content">

        @include('blogs.layouts.sidebar')

        <div class="col-sm-6 col-sm-offset-1">
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

            <div class="m-t-30">

                <div class="wrapper">
                    <div class="top-icons">
                        <i class="fas fa-long-arrow-alt-left"></i>
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="far fa-heart"></i>
                    </div>

                    <div class="profile">
                        {{-- <img
                            src="https://images.unsplash.com/photo-1484186139897-d5fc6b908812?ixlib=rb-0.3.5&s=9358d797b2e1370884aa51b0ab94f706&auto=format&fit=crop&w=200&q=80%20500w"
                            class="thumbnail"> --}}
                        <img src="{{$user->profile_path()}}" alt="{{$user->name}}" class="thumbnail">
                        <div class="check"><i class="fas fa-check"></i></div>
                        <h3 class="name">{{$user->name}}</h3>
                        <p class="title">Javascript Developer</p>
                        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque aliquam
                            aliquid porro!</p>

                        @if (auth()->id() == request()->query('user'))
                        <a href="{{route('profile.edit', $user)}}"><button class="btn">Edit</button></a>
                        @elseif( ! $user->has_friends())
                        <button class="btn" onclick="event.preventDefault();
                            document.getElementById('form-{{$user->id}}').submit();" href="#">Send
                            Request</button>
                        <form id="form-{{$user->id}}" action="{{route('current_user_find_friends')}}" method="post"
                            class="d-none">
                            @csrf
                            @method('post')
                            <input type="hidden" name="friend_id" value="{{$user->id}}">
                        </form>
                        @endif
                    </div>

                    <div class="social-icons">
                        <div class="icon">
                            <a href="{{route('posts.index', ['user' => request()->query('user')])}}"><span
                                    class="glyphicon glyphicon-list-alt"></span></a>
                            <h4>{{$user->posts->count()}}</h4>
                            <p>{{$user->posts->count() > 1 ? 'Posts' : 'Post'}}</p>
                        </div>

                        <div class="icon">
                            <a href="#"><span class="glyphicon glyphicon-comment"></span></a>
                            <h4>{{$user->comments->count()}}</h4>
                            <p>{{$user->comments->count() > 1 ? 'Comments' : 'Comment'}}</p>
                        </div>

                        <div class="icon">
                            <a href="#"><span class="glyphicon glyphicon-bullhorn"></span></a>
                            <h4>Join</h4>
                            <p>{{$user->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/profile.css')}}">
@endsection