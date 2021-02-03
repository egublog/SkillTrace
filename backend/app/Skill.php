<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    public function user_language() {
        return $this->belongsTo('App\User_language');
    }
}
