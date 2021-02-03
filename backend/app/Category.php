<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function user_languages() {
        return $this->hasMany('App\Trace');
    }
}
