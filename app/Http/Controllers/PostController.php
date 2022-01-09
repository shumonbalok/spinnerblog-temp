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
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Cache::remember('posts', 5000, function () {
            return Post::with('user')->paginate(5);
        });

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
        // $request->safe()->merge(['name' => 'Taylor Otwell']);
        $data = ['user_id' => auth()->id()] + $request->validated();
        $post = Post::create($data)->refresh();
        $this->saveImage($post);
        return redirect('/posts')->with('success', 'Post Created Successfull');
    }

    /**
     * Save Image to Image Model.
     *
     * @param  \App\Models\Post  $post
     */

    private function saveImage($post)
    {
        if (request()->hasFile('image')) {
            if (request()->isMethod('patch') &&  Storage::exists($post->image->image)) {
                Storage::delete($post->image->image);
                $post->image()->forceDelete();
            }
            $path  = request()->file('image')->store('posts');
            $post->image()->create(['image' => $path]);
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
        $post->update($request->validated());
        $this->saveImage($post->refresh());
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
        $post->image()->delete();
        $post->delete();
        return redirect('/posts')->with('success', 'Deleted successfull');
    }
}
