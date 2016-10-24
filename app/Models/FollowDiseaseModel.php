<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowDiseaseModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'follow_disease_model';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'disease_model_id', 'is_valid', 'station_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function model()
    {
        return $this->hasOne('App\Models\DiseaseModel', 'id');
    }

    public function station()
    {
        return $this->hasOne('App\Models\Station', 'id');
    }
}