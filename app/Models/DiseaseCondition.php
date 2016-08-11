<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiseaseCondition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'disease_model_id', 'clsf_weather_parameter', 'start_range', 'end_range', 'constant', 'operator', 'time'
    ];

    /**
     * Many to one relation
     *
     * @return Illuminate\Database\Eloquent\Relations\belongTo
     */
    public function diseaseModel()
    {
        return $this->belongsTo('App\Models\DiseaseModel');
    }

    /**
     * Get the weather parameter record associated with the disease model.
     */
    public function weatherParameter()
    {
        return $this->hasOne('App\Models\ClsfWeatherParameter');
    }
}