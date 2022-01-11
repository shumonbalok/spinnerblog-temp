@extends('blogs.layouts.app')

@section('content')
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-sm-10 text-left">

            <div class="thumbnail" style="margin-top: 20px">
                <div class="caption">
                    <h4 id="thumbnail-label">Update Comment</h4>
                    <form class="form-horizontal" action="{{route('comments.update', $comment)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        @if ($comment->body)
                        <div class="form-group @error('body') has-error has-feedback @enderror">
                            <label class="control-label col-sm-2" for="body">Comment:</label>
                            <div class="col-sm-10">
                                <input type="text" name="body" value="{{$comment->body}}" class="form-control"
                                    placeholder="Enter Comment">
                                @error('body')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="form-group @error('status') has-error has-feedback @enderror">
                            <label class="control-label col-sm-2" for="status">Status:</label>
                            <div class="col-sm-10">
                                <select type="text" name="status" class="form-control">
                                    <option value="0" @if ($comment->status==0) selected @endif>Only Me</option>
                                    <option value="1" @if ($comment->status==1) selected @endif>Public</option>
                                    <option value="2" @if ($comment->status==2) selected @endif>Just Friend</option>
                                </select>
                                @error('status')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if ($comment->image)
                        <div class="form-group @error('image') has-error has-feedback @enderror">
                            <label class="control-label col-sm-2" for="dscp">Image:</label>
                            <div class="col-sm-10">
                                <img src="{{$comment->image_path()}}" alt="Image" style="width: 200px">
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endif

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