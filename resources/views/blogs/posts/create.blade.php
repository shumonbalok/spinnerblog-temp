@extends('blogs.layouts.app')

@section('content')
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-sm-10 text-left">

            <div class="thumbnail" style="margin-top: 20px">
                <div class="caption">
                    <h4 id="thumbnail-label">Create Post</h4>
                    <form class="form-horizontal" action="{{route('posts.store')}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="form-group @error('title') has-error has-feedback @enderror">
                            <label class="control-label col-sm-2" for="title">Title:</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{old('title')}}" class="form-control"
                                    placeholder="Enter Title" autofocus>
                                @error('title')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group @error('dscp') has-error has-feedback @enderror">
                            <label class="control-label col-sm-2" for="dscp">Description:</label>
                            <div class="col-sm-10">
                                <textarea name="dscp" class="form-control"
                                    placeholder="Enter Description">{{old('dscp')}}</textarea>
                                @error('dscp')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group @error('status') has-error has-feedback @enderror">
                            <label class="control-label col-sm-2" for="status">Status:</label>
                            <div class="col-sm-10">
                                <select type="text" name="status" class="form-control">
                                    <option value="0" @if (old('status')==0) selected @endif>Pending</option>
                                    <option value="1" @if (old('status')==1) selected @endif>Publish</option>
                                </select>
                                @error('status')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group @error('image') has-error has-feedback @enderror">
                            <label class="control-label col-sm-2" for="dscp">Banner Image:</label>
                            <div class="col-sm-10">
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection