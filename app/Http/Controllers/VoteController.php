<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['postVote', 'commentVote']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postVote(Request $request, Post $post)
    {
        if ($post->voteByuser()) {
            return back()->with('warning', 'You already have liked this post');
        }
        $post->votes()->create(['vote' => 1, 'user_id' => auth()->id()]);
        return back()->with('success', 'Your liked have been saved!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commentVote(Request $request, Comment $comment)
    {
        //return $comment->id;
        if ($comment->voteByuser()) {
            return back()->with('warning', 'You already have liked this comment');
        }
        $comment->votes()->create(['vote' => 1, 'user_id' => auth()->id()]);
        return back()->with('success', 'Your liked have been saved!');
    }
}
