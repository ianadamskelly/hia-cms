<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'author'])
            ->published()
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }
}
