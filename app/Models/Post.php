<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Bookmark;
use App\Models\PostVote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    public function postvotes()
    {
        return $this->hasMany(PostVote::class);
    }
    public function votedBy(User $user)
    {
        return $this->postvotes->contains('user_id', $user->id);
    }
}
