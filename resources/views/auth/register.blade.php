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
                        <div class="form-group">
                            <label for="email">Name:</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pwd">E-Mail Address:</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pwd">Comfirm Password:</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label for="image">Profile Picture:</label>
                            <input id="image" type="file" class="form-control" name="image">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
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