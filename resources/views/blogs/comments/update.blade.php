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