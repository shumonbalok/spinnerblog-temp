<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'update', 'edit', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        if ($request->body) {
            $data = $request->validate([
                'body' => 'required|max:100',
            ]);
            $post->comments()->create(['body' => $data['body'], 'user_id' => auth()->id()]);
            return back()->with('success', 'Comment added success!');
        } elseif ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|max:512|mimes:jpg,png',
            ]);
            $comment = $post->comments()->create(['body' => null, 'user_id' => auth()->id()])->refresh();
            $this->saveImage($comment);
            return back()->with('success', 'Comment added success!');
        }
    }


    private function saveImage($comment)
    {
        if (request()->hasFile('image')) {
            if (request()->isMethod('patch') &&  Storage::exists($comment->image->image)) {
                Storage::delete($comment->image->image);
                $comment->image()->forceDelete();
            }
            $path  = request()->file('image')->store('posts/comments');
            $comment->image()->create(['image' => $path]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('blogs.comments.update', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        // return $request->all();
        $data = $request->validate([
            'body' => 'required|max:100',
        ]);
        $comment->update(['body' => $data['body']]);

        return redirect('/posts/' . $comment->post_id)->with('success', 'Comment Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
