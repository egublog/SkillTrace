<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function userLanguages()
    {
        return $this->hasMany('App\Models\Trace');
    }
}
