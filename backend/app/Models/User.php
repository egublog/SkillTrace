<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function history()
    {
        return $this->belongsTo('App\Models\History');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Models\Language', 'user_languages', 'user_id', 'language_id');
    }

    public function userLanguages()
    {
        return $this->hasMany('App\Models\UserLanguage');
    }

    public function follow()
    {
        return $this->belongsToMany('App\Models\User', 'follows', 'user_id', 'user_to_id');
    }

    public function follow_to()
    {
        return $this->belongsToMany('App\Models\User', 'follows', 'user_to_id', 'user_id');
    }

    public function talk()
    {
        return $this->belongsToMany('App\Models\User', 'talks', 'user_id', 'user_to_id');
    }

    public function talk_to()
    {
        return $this->belongsToMany('App\Models\User', 'talks', 'user_to_id', 'user_id');
    }

    public function follows()
    {
        return $this->hasMany('App\Models\Follow', 'user_id');
    }

    public function follows_to()
    {
        return $this->hasMany('App\Models\Follow', 'user_to_id');
    }

    //scope

    // public function scopeSearchName($query, $name)
    // {
    //     return $query->when($name, function ($query) use ($name) {
    //         return $query->where('name', 'like', "%$name%");
    //     });
    // }
    // public function scopeSearchAge($query, $age)
    // {
    //     return $query->when($age, function ($query) use ($age) {
    //         return $query->where('age', 'like', "%$age%");
    //     });
    // }
    // public function scopeSearchArea($query, $area_id)
    // {
    //     return $query->when($area_id, function ($query) use ($area_id) {
    //         return $query->where('area_id', 'like', "%$area_id%");
    //     });
    // }
    // public function scopeSearchHistory($query, $history_id)
    // {
    //     return $query->when($history_id, function ($query) use ($history_id) {
    //         return $query->where('history_id', 'like', "%$history_id%");
    //     });
    // }
    // public function scopeSearchLanguage($query, $language_id)
    // {
    //     return $query->when($language_id, function ($query) use ($language_id) {
    //         return $query->where('language_id', 'like', "%$language_id%");
    //     });
    // }
}
