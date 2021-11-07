<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    function replys()
    {
        return $this->hasMany('App\Models\Post', 'fr_category_id', 'id');
    }
    function user()
    {
        return $this->belongsTo('App\Models\User', 'fr_user_id', 'id');
    }
    function post()
    {
        return $this->belongsTo('App\Models\Post', 'fr_post_id', 'id');
    }
}
