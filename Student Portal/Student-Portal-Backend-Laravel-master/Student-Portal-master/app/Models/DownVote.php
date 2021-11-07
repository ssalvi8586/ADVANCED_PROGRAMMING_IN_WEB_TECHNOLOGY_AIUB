<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownVote extends Model
{
    use HasFactory;
    public $table = 'down_votes';
}
