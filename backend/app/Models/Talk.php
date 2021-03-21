<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    
    public function user_follower() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function user_following() {
        return $this->belongsTo('App\Models\User', 'user_to_id');
    }

}
