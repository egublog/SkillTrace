<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'name'
        'updated_at',
        'created_at',
    ];

    public function traces()
    {
        return $this->hasMany('App\Models\Trace');
    }
}
