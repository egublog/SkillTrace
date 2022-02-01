<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Userテーブルを操作するモデルクラス
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * ブラックリスト
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'password',
        'remember_token',
    ];

    /**
     * 隠したいカラム
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * castで型変更
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    //リレーション

    public function area()
    {
        return $this->belongsTo(App\Models\Area::class);
    }

    public function history()
    {
        return $this->belongsTo(App\Models\History::class);
    }

    public function language()
    {
        return $this->belongsTo(App\Models\Language::class);
    }

    public function languages()
    {
        return $this->belongsToMany(App\Models\Language::class, 'user_languages', 'user_id', 'language_id');
    }

    public function userLanguages()
    {
        return $this->hasMany(App\Models\UserLanguage::class);
    }

    public function follow()
    {
        return $this->belongsToMany(App\Models\User::class, 'follows', 'user_id', 'user_to_id');
    }

    public function follow_to()
    {
        return $this->belongsToMany(App\Models\User::class, 'follows', 'user_to_id', 'user_id');
    }

    public function talk()
    {
        return $this->belongsToMany(App\Models\User::class, 'talks', 'user_id', 'user_to_id');
    }

    public function talk_to()
    {
        return $this->belongsToMany(App\Models\User::class, 'talks', 'user_to_id', 'user_id');
    }

    public function follows()
    {
        return $this->hasMany(App\Models\Follow::class, 'user_id');
    }

    public function follows_to()
    {
        return $this->hasMany(App\Models\Follow::class, 'user_to_id');
    }
}
