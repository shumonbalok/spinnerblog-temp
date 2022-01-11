@extends('blogs.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="thumbnail" style="margin: 100px 0">
                <div class="caption">
                    <h3 id="thumbnail-label" class="taxt-center">{{ __('Register') }}</h3>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group @error('name')  has-error has-feedback @enderror">
                            <label for="email">Name:</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                autocomplete="name" autofocus>
                            @error('name')
                            <span class="help-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('email')  has-error has-feedback @enderror">
                            <label for="pwd">E-Mail Address:</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                autocomplete="email">

                            @error('email')
                            <span class="help-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group @error('password')  has-error has-feedback @enderror">
                            <label for="password">Password:</label>
                            <input id="password" type="password" class="form-control" name="password"
                                autocomplete="new-password" style="margin-bottom: 5px;">
                            <input type="checkbox" onclick="showPassword('password')">Show Password
                            @error('password')
                            <span class="help-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pwd">Comfirm Password:</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" autocomplete="new-password" style="margin-bottom: 5px;">
                            <input type="checkbox" onclick="showPassword('password-confirm')">Show Password
                        </div>
                        <div class="form-group @error('image')  has-error has-feedback @enderror">
                            <label for="image">Profile Picture:</label>
                            <input id="image" type="file" class="form-control" name="image">
                            @error('image')
                            <span class="help-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="pwd">Status:</label>
                            <select class="form-control" name="status">
                                <option>Panding</option>
                                <option>Approved</option>
                            </select>
                        </div> --}}
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection