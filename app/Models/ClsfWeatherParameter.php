<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClsfWeatherParameter extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clsf_weather_parameter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}