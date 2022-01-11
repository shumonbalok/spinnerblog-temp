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
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->query('current_user_comments')) {
            auth()->id() != request()->query('current_user_comments') ? abort(401, 'You are not authorize for this action!') :
                $comments = Comment::withoutGlobalScope('publish')->where('user_id', auth()->id())->with('post')->paginate(5)->withQueryString();
            return view('blogs.comments.index', compact('comments'));
        }
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
    public function store(Request $request)
    {
        if ($request->body) {
            $data = $request->validate([
                'body' => 'required|max:200',
            ]);
            $body = $data['body'];
            $path = null;
        } elseif ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|max:512|mimes:jpg,png',
            ]);
            $path = $request->file('image')->store('posts/comments');
            $body = null;
        }
        Comment::create(['body' => $body, 'image' => $path, 'user_id' => auth()->id(), 'post_id' => $request->post_id])->refresh();
        return back()->with('success', 'Comment added success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        // if (request()->query('current_user_comments')) {
        //     $comments = Post::where('user_id', auth()->id())->with('post')->paginate(10)->withQueryString();
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $comment->authorize();
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
        //return $request->body;
        $comment->authorize();
        if ($request->body) {
            $data = $request->validate([
                'body' => 'required|max:200',
            ]);
            $body = $data['body'];
        } elseif ($request->hasFile('image')) {
            $path = $this->hasImage($comment);
        } elseif ($request->status && $request->hasFile('image')) {
            $path = $this->hasImage($comment);
        }

        $comment->update(['body' => $body ?? null, 'status' => $request->status, 'image' => $path ?? $comment->image]);

        return redirect('/posts/' . $comment->post_id)->with('success', 'Comment Updated Success!');
    }


    public function hasImage($comment)
    {
        request()->validate([
            'image' => 'required|max:512|mimes:jpg,png',
        ]);
        if (Storage::exists($comment->image)) {
            Storage::delete($comment->image);
        }
        return $path = request()->file('image')->store('posts/comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->authorize();
        $comment->delete();
        return back()->with('success', 'Comment Deleted Success!');
    }
}
