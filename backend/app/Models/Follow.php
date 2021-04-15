<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    public function user_follower()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function user_following()
    {
        return $this->belongsTo('App\Models\User', 'user_to_id');
    }

    /**
     * scope
     *
     * @var \Illuminate\Database\Query\Builder
     */
    public function scopeFollowing($query, $userId)
    {
        return $query->where('user_id', $userId)->with('user_following');
    }

    public function scopeFollower($query, $userId)
    {
        return $query->where('user_to_id', $userId)->with('user_follower');
    }

    public function scopeMutualFollow($query, $myId, $userId)
    {
        return $query->where('user_id', $myId)->where('user_to_id', $userId);
    }

    /**
     * 自分がその人をフォローしているかどうかの判定
     *
     * @return void
     */
    public static function followCheck($followCheck)
    {

        if ($followCheck == null) {
            $followCheck = false;
        } else {
            $followCheck = true;
        }
    }
}
