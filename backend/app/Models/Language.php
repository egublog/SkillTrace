<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;


/**
 * Languageテーブルを操作するモデルクラス
 */
class Language extends Model
{
    protected $fillable = [
        'id',
        'name',
        'favicon',
        'updated_at',
        'created_at'
    ];

    protected $casts = [
        'created_at'             => 'datetime',
        'updated_at'             => 'datetime',
    ];

    public function languages() {
        return $this->hasMany(App\Models\User::class, 'language_id', 'id');
    }

    public function users() {
        return $this->belongsToMany(App\Models\User::class, 'user_languages', 'language_id', 'user_id');
    }

}
