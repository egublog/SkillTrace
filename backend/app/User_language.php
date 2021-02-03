<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_language extends Model
{
    //
    protected $table = 'user_languages';
    // 単数と複数の関係を機械が認識してくれなさそうならかく

    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function language() {
        return $this->belongsTo('App\Language');
    }

    public function trace() {
        return $this->hasMany('App\Trace');
    }

    public function skill() {
        return $this->hasMany('App\Skill');
    }



}
