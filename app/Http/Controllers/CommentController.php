<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
            'commentbody' => 'required',
        ]);

        $request->user()->comments()->create([
            'post_id' => $post->id,
            'commentbody' => $request->commentbody,
        ]);
        return back();
    }
    
}
