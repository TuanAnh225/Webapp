<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {
        $post_ids = $request->user()->bookmarks()->get('post_id');
        $posts = Post::find($post_ids);
        return view('bookmark',[
            'posts' => $posts,
        ]);
    }
    public function store(Request $request, Post $post)
    {
        $request->user()->bookmarks()->create([
            'post_id' => $post->id,
        ]);
        return back();
    }
}
