<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiseaseModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'disease_models';

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