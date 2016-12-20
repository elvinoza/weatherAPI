<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forecast';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'station_id',
        'temperature',
        'humidity',
        'pressure',
        'soil_temperature',
        'soil_humidity',
        'wind_speed',
        'wind_direction',
        'rain',
        'forecast_date',
    ];

    /**
     * Many to one relation
     *
     * @return Illuminate\Database\Eloquent\Relations\belongTo
     */
    public function station()
    {
        return $this->belongsTo('App\Models\Station', 'id');
    }
}