<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = auth()->user();
        $posts = $user->posts()->latest()->paginate(5);
        return view('post.index', compact('posts', 'user'));
    }
    public function store(PostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = auth()->user()->id;
        Post::create([
            'user_id'=>$user,
            'title'=>$data['title'],
            'content'=>$data['content']
        ]);
        return back();
    }
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();
        $post->update($data);
        return redirect('/posts');
    }
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return back();
    }
}
