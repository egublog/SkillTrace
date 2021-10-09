<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Language extends Model
{
    protected $fillable = [
        'id',
        'name',
        'favicon',
        'updated_at',
        'created_at'
    ];
    
    public function languages() {
        return $this->hasMany('App\Models\User');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User', 'user_languages', 'language_id', 'user_id');
    }

}
