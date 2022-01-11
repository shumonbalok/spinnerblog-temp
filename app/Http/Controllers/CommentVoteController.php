<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentVote;
use Illuminate\Http\Request;

class CommentVoteController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->only(['commentVote']);
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
