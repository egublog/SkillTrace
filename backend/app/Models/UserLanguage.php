<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * UserLanguageテーブルを操作するモデルクラス
 */
class UserLanguage extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'language_id',
        'star_count',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'created_at'             => 'datetime',
        'updated_at'             => 'datetime',
    ];

    // 単数と複数の関係を機械が認識してくれなさそうならかく
    protected $table = 'user_languages';

    public function user()
    {
        return $this->belongsTo(App\Models\User::class);
    }

    public function language()
    {
        return $this->belongsTo(App\Models\Language::class);
    }

    public function ability()
    {
        return $this->hasMany(App\Models\Ability::class);
    }

    public function trace()
    {
        return $this->hasMany(App\Models\Trace::class);
    }

    /**
     * scope
     *
     * @return Illuminate\Database\Eloquent\Builder
     */

     public function scopeGetLanguageAsc($query, $userId)
     {
        return $query->where('user_id', $userId)->with('language')->orderBy('language_id', 'asc');
     }

     public function scopeGetLanguage($query, $userId, $skillId)
     {
        return $query->where('user_id', $userId)->where('language_id', $skillId);
     }
}
