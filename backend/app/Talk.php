<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    
    public function user_follower() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function user_following() {
        return $this->belongsTo('App\User', 'user_to_id');
    }

}
