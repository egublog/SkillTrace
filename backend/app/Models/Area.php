<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'id',
        'name',
        'updated_at',
        'created_at',
    ];

    public function users() {
        return $this->hasMany(App\Models\User::class, 'area_id', 'id');
    }

}
