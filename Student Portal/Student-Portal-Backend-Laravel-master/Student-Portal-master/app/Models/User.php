<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    function admin()
    {
        return $this->hasOne('App\Models\Admin', 'fr_user_id', 'id');
    }
    function moderator()
    {
        return $this->hasOne('App\Models\moderator', 'fr_user_id', 'id'); 
    }
    function instructor()
    {
        return $this->hasOne('App\Models\Instructor', 'fr_user_id', 'id'); 
    }
    function student()
    {
        return $this->hasOne('App\Models\Student', 'fr_user_id', 'id'); 
    }
    function votes()
    {
        return $this->hasMany('App\Models\Vote', 'fr_user_id', 'id');
    }
    function comments()
    {
        return $this->hasMany('App\Models\Comment', 'fr_user_id', 'id');
    }
    function replys()
    {
        return $this->hasMany('App\Models\Reply', 'fr_user_id', 'id');
    }
    function posts()
    {
        return $this->hasMany('App\Models\Post', 'fr_user_id', 'id');
    }
    function favourites()
    {
        return $this->hasMany('App\Models\Favourite', 'fr_user_id', 'id');
    }
    function followers()
    {
        return $this->hasMany('App\Models\Follower', 'fr_follower_user_id', 'id');
    }
    function followings()
    {
        return $this->hasMany('App\Models\Post', 'fr_following_user_id', 'id');
    }
    function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'fr_user_id', 'id');
    }
}
