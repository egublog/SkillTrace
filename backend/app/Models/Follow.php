<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    public function user_follower() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function user_following() {
        return $this->belongsTo('App\Models\User', 'user_to_id');
    }

    // scope
    public function scopeFollowing($query, $userId) {
        return $query->where('user_id', $userId);
    }

    public function scopeFollower($query, $userId) {
        return $query->where('user_to_id', $userId);
    }
    
    public function scopeMutualFollow($query, $myId, $userId) {
        return $query->where('user_id', $myId)->where('user_to_id', $userId);
    }

    public static function followCheck($follow_check) {

        if($follow_check == null) {
            $follow_check = false;
        }else {
            $follow_check = true;
        }

    }
}
