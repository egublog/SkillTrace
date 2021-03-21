<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    public function user_language() {
        return $this->belongsTo('App\Models\User_language');
    }
}
