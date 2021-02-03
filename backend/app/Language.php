<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Language extends Model
{
    //
    public function languages() {
        return $this->hasMany('App\User');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_languages', 'language_id', 'user_id');
    }


}
