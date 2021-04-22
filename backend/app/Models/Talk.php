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

    /**
     * scope
     *
     * @return \Illuminate\Database\Query\Builder
     */

    public function scopeTalking($query, $id)
    {
        return $query->where('user_id', $id);
    }
    
    public function scopeTalked($query, $id)
    {
        return $query->where('user_to_id', $id);
    }
    
    public function scopeTalk($query, $myId, $theFriendId)
    {
        return $query->where('user_id', $myId)
        ->where('user_to_id', $theFriendId)
        ->orWhere('user_id', $theFriendId)
        ->where('user_to_id', $myId);
    }

    public function scopeTalkingListLatest($query, $myId)
    {
        return $query->where('user_id', $myId)->orWhere('user_to_id', $myId)->latest();
    }

    /**
     * 既読処理
     *
     * @return void
     */
    public static function readCheck($yetColumns)
    {
        if (isset($yetColumns->first()->user_id)) 
        {
            foreach ($yetColumns as $yetColumn) {
                $yetColumn->yet = true;
                $yetColumn->save();
            }
        }
    }
}
