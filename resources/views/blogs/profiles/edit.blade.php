@extends('blogs.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="thumbnail" style="margin: 20px 0">
                <div class="caption">
                    <h3 id="thumbnail-label" class="taxt-center">Update Profile</h3>
                    <form method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group @error('name')  has-error has-feedback @enderror">
                            <label for="email">Name:</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}">
                            @error('name')
                            <span class="help-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('email')  has-error has-feedback @enderror">
                            <label for="pwd">E-Mail Address:</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}"
                                disabled>

                            @error('email')
                            <span class="help-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group @error('image') has-error has-feedback @enderror">
                            <label class="control-label" for="dscp">Profile Image:</label>
                            <div class="">
                                <img src="{{$user->profile_path()}}" alt="Image" style="width: 200px">
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group  @error('email')  has-error has-feedback @enderror">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Reset Password?') }}
                            </a>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection