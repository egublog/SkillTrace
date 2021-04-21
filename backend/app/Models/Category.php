<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function traces()
    {
        return $this->hasMany('App\Models\Trace');
    }
}
