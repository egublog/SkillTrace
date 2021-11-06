<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Talk extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'user_to_id',
        'talk_body',
        'yet',
        'updated_at',
        'created_at',
    ];

    public function user_follower() {
        return $this->belongsTo(App\Models\User::class, 'user_id');
    }

    public function user_following() {
        return $this->belongsTo(App\Models\User::class, 'user_to_id');
    }

    /**
     * scope
     * // NOTE: ここはRepository層に置き換える
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
        ->orWhere(function($q) use ($theFriendId, $myId) {
            $q->where('user_id', $theFriendId)
                ->where('user_to_id', $myId);
        });
    }

    public function scopeTalkingListLatest($query, $myId)
    {
        return $query->where('user_id', $myId)->orWhere(function($q) use ($myId) {
            $q->where('user_to_id', $myId);
        })->latest();
    }

    /**
     * 既読処理
     * // NOTE: ここはRepository層に置き換える
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

    /**
     * 重複をなくしてリストを取る
     *
     * @return array
     */

    public static function getTalkingList($myId, $talkLists)
    {
        $talkingUsers = [];
        $talkingUsersId = [];

        foreach ($talkLists as $talkList) {
            if ($talkList->user_id != $myId) {
                $talkingUsersId[] = $talkList->user_id;
            }
            if ($talkList->user_to_id != $myId) {
                $talkingUsersId[] = $talkList->user_to_id;
            }
        }

        if ($talkingUsersId) {
            $talkingUsersId = array_unique($talkingUsersId);
        }

        if ($talkingUsersId) {
            foreach ($talkingUsersId as $talkingUserId) {
                $talkingUsers[] = User::find($talkingUserId);
            }
        }

        return $talkingUsers;
    }

    /**
     * search
     *
     * @return array
     */

    public static function search($talkingUsersBeforeSearch, $searchResultName)
    {
        $talkingUsers = [];

        foreach($talkingUsersBeforeSearch as $talkingUser) {
            if(str_contains($talkingUser->name, $searchResultName)) {
                $talkingUsers[] = $talkingUser;
            }
        }

        return $talkingUsers;
    }
}
