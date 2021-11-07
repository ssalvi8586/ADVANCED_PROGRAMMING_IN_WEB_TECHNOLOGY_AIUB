<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    function posts()
    {
        return $this->hasMany('App\Models\Post', 'fr_category_id', 'id');
    }
}
