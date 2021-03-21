<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function user_languages() {
        return $this->hasMany('App\Models\Trace');
    }
}
