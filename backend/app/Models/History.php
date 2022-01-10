<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Historyテーブルを操作するモデルクラス
 */
class History extends Model
{
    protected $fillable = [
        'id',
        'name',
        'updated_at',
        'created_at',
    ];

    public function users() {
        return $this->hasMany(App\Models\User::class, 'history_id', 'id');
    }

}
