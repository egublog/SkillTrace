<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function userLanguage()
    {
        return $this->belongsTo('App\Models\UserLanguage');
    }
}
