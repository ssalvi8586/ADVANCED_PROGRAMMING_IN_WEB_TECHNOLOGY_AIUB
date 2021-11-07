<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    function user()
    {
        return $this->belongsTo('App\Models\User', 'fr_user_id', 'id');
    }
    function comments()
    {
        return $this->hasMany('App\Models\Comment', 'fr_post_id', 'id');
    }
    function replys()
    {
        return $this->hasMany('App\Models\Reply', 'fr_post_id', 'id');
    }
    function upvotes()
    {
        return $this->hasMany('App\Models\UpVote', 'fr_post_id', 'id');
    }
    function downvotes()
    {
        return $this->hasMany('App\Models\DownVote', 'fr_post_id', 'id');
    }
    function category()
    {
        return $this->belongsTo('App\Models\Category', 'fr_category_id', 'id');
    }
}
