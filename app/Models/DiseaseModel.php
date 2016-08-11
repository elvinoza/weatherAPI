<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiseaseModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'user_id'
    ];

    public function conditions()
    {
        return $this->hasMany('App\Models\DiseaseCondition');
    }
}