<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    function qualifications()
    {
        return $this->hasMany('App\Models\Qualification', 'fr_instructor_id', 'id');
    }
}
