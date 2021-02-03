<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    //
    public function category() {
        return $this->belongsTo('App\Category');
    }
    public function user_language() {
        return $this->belongsTo('App\User_language');
    }
}
