<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
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
        if (auth()->check() && request()->query('current_user_posts')) {
            if (auth()->id() != request()->query('current_user_posts')) {
                abort(401, 'You are not authorize for this action!');
            } else {
                $posts = Post::where('user_id', auth()->id())->with('user')->latest()->paginate(5)->withQueryString();
            }
        } else {
            $posts = Post::publish()->with('user')->latest()->paginate(5);
        }
        return view('blogs.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = ['user_id' => auth()->id()] + $request->validated();
        $path = $this->saveImage($request);
        $data['image'] = $path;
        Post::create($data)->refresh();
        return redirect('/posts')->with('success', 'Post Created Successfull');
    }

    /**
     * Save Image to Image Model.
     *
     * @param  \App\Models\Post  $post
     */

    private function saveImage($image)
    {
        if (request()->hasFile('image')) {
            return request()->file('image')->store('posts');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = $post->load('comments');
        return view('blogs.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post->authorize();
        return view('blogs.posts.update', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->authorize();
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $request->file('image');
            if (Storage::exists($post->image)) {
                Storage::delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts');
        }
        $post->update($data);
        return redirect('/posts')->with('success', 'Updated successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->authorize();
        $post->delete();
        return redirect('/posts')->with('success', 'Deleted successfull');
    }
}
