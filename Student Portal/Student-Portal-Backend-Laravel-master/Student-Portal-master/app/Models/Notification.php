<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    function user()
    {
        return $this->belongsTo('App\Models\User', 'fr_user_id', 'id');
    }
    function userNotifier()
    {
        return $this->belongsTo('App\Models\User', 'fr_notifier_user_id', 'id');
    }
}
