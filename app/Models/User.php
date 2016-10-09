<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

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

    public function notificationsInfo()
    {
        return $this->hasOne('App\Models\Notification');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }
}
