<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    // 単数と複数の関係を機械が認識してくれなさそうならかく
    protected $table = 'user_languages';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    public function ability()
    {
        return $this->hasMany('App\Models\Ability');
    }

    public function trace()
    {
        return $this->hasMany('App\Models\Trace');
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
