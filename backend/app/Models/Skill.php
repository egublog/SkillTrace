<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    public function userLanguage()
    {
        return $this->belongsTo('App\Models\UserLanguage');
    }
}
