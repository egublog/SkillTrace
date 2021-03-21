<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_language extends Model
{
    //
    protected $table = 'user_languages';
    // 単数と複数の関係を機械が認識してくれなさそうならかく

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    
    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function trace() {
        return $this->hasMany('App\Models\Trace');
    }

    public function skill() {
        return $this->hasMany('App\Models\Skill');
    }



}
