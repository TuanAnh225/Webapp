<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentVoteController extends Controller
{
    public function store(Comment $comment, $vote, Request $request)
    {
        $user=$request->user();
        if($comment->votedBy($user)) //Da vote
        {
            if(!$comment->commentvotes->where('user_id',$user->id)->contains('vote',$vote)) // Vote moi khac vote cu
              {
                  $user->commentvotes()->where('comment_id',$comment->id)->update(['vote' => $vote]); // update vote
                  return back();           
             }  
            else{
                dd('Forbidden');
            }   
        }
        else
        {
            $user->commentvotes()->create([
                'comment_id' => $comment->id,
                'vote' => $vote,
            ]);
            return back();
        }
    }
    public function destroy(Comment $comment,Request $request)
    {
        $request->user()->commentvotes()->where('comment_id',$comment->id)->delete();
        return back();
    }
}
