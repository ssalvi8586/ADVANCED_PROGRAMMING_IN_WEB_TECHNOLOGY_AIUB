<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;


    function sender()
    {
        return $this->belongsTo('App\Models\User', 'fr_sender_id', 'id');
    }

    function reciver()
    {
        return $this->belongsTo('App\Models\User', 'fr_reciver_id', 'id');
    }
}
