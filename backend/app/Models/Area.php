<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'id',
        ''
    ];

    public function users() {
        return $this->hasMany('App\Models\User');
    }

}
