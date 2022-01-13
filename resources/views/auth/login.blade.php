@extends('blogs.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="thumbnail" style="margin: 150px 0">
                <div class="caption">
                    <h3 id="thumbnail-label" class="taxt-center">Login</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group @error('email')  has-error has-feedback @enderror">
                            <label for="pwd">E-Mail Address:</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="help-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group @error('password')  has-error has-feedback @enderror">
                            <label for="pwd">Password:</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            <input type="checkbox" onclick="showPassword('password')">Show Password
                            @error('password')
                            <span class="help-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="checkbox">
                            <label><input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                    old('remember') ? 'checked' : '' }}> Remember me</label>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection