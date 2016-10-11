<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The custom attributes.
     *
     * @var array
     */
    protected $appends = [
        'user_not'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function stations()
    {
        return $this->hasMany('App\Models\Station');
    }

    public function diseaseModels()
    {
        return $this->hasMany('App\Models\DiseaseModel');
    }

    public function userNotify()
    {
        return $this->hasOne('App\Models\UserNotify');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function getUserNotAttribute()
    {
        return $this->userNotify;
    }
}
