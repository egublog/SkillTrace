<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Followテーブルを操作するモデルクラス
 */
class Follow extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'user_to_id',
        'updated_at',
        'created_at',
    ];

    public function user_follower()
    {
        return $this->belongsTo(App\Models\User::class, 'user_id');
    }

    public function user_following()
    {
        return $this->belongsTo(App\Models\User::class, 'user_to_id');
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
