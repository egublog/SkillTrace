<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Categoryテーブルを操作するモデルクラス
 */
class Category extends Model
{
    protected $fillable = [
        'id',
        'name',
        'updated_at',
        'created_at',
    ];

    public function traces()
    {
        return $this->hasMany(App\Models\Trace::class, 'trace_id', 'id');
    }
}
