<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostVoteController extends Controller
{
    public function store(Post $post, $vote, Request $request)
    {
        $user = $request->user();
        if ($post->votedBy($user)) //vote roi
        {
            if (!$post->postvotes->where('user_id',$user->id)->contains('vote',$vote))//Vote khac
            {
                $user->postvotes()->where('post_id',$post->id)->update(['vote' => $vote]); //update lai
                return back();
            }
            else {
                dd('Forbidden');
            }
        }
        else {
            $user->postvotes()->create([
                'post_id' => $post->id,
                'vote' => $vote,
            ]);
        }
        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->postvotes()->where('post_id', $post->id)->delete();
        return back();
    }
}
