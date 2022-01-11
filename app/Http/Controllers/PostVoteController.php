<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Http\Request;

class PostVoteController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->only(['postVote']);
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
}
