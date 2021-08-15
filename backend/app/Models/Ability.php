<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $fillable = [
        'id',
        'user_language_id',
        'content',
        'updated_at',
        'created_at'
    ];
    //
    public function userLanguage()
    {
        return $this->belongsTo('App\Models\UserLanguage');
    }
}
