<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Traceテーブルを操作するモデルクラス
 */
class Trace extends Model
{
    protected $fillable = [
        'id',
        'user_language_id',
        'img',
        'category_id',
        'content',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'created_at'             => 'datetime',
        'updated_at'             => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(App\Models\Category::class);
    }
    public function userLanguage()
    {
        return $this->belongsTo(App\Models\UserLanguage::class);
    }
}
