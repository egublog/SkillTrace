<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    //
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    public function user_language() {
        return $this->belongsTo('App\Models\User_language');
    }
}
