@extends('blogs.layouts.app')

@section('content')
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-sm-10 text-left">

            <div class="thumbnail" style="margin-top: 20px">
                <div class="caption">
                    <h4 id="thumbnail-label">Update Post</h4>
                    <form class="form-horizontal" action="{{route('posts.update', $post)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group @error('title') has-error has-feedback @enderror">
                            <label class="control-label col-sm-2" for="title">Title:</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{$post->title}}" class="form-control"
                                    placeholder="Enter Title">
                                @error('title')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group @error('description') has-error has-feedback @enderror">
                            <label class="control-label col-sm-2" for="description">Description:</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control"
                                    placeholder="Enter Description">{{$post->description}}</textarea>
                                @error('description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group @error('status') has-error has-feedback @enderror">
                            <label class="control-label col-sm-2" for="status">Status:</label>
                            <div class="col-sm-10">
                                <select type="text" name="status" class="form-control">
                                    <option value="0" @if ($post->status==0) selected @endif>Only Me</option>
                                    <option value="1" @if ($post->status==1) selected @endif>Public</option>
                                    <option value="2" @if ($post->status==2) selected @endif>Just Friend</option>
                                </select>
                                @error('status')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group @error('image') has-error has-feedback @enderror">
                            <label class="control-label col-sm-2" for="dscp">Banner Image:</label>
                            <div class="col-sm-10">
                                <img src="{{$post->banner_path()}}" alt="Image" style="width: 200px">
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