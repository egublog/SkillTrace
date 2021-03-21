<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Language extends Model
{
    //
    public function languages() {
        return $this->hasMany('App\Models\User');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User', 'user_languages', 'language_id', 'user_id');
    }


}
