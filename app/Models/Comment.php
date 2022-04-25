<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentbody',
        'post_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class); 
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function commentvotes()
    {
        return $this->hasMany(CommentVote::class);
    }
    public function votedby(User $user)
    {
        return $this->commentvotes->contains('user_id',$user->id);
    }
    
}
