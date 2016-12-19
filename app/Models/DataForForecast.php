<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataForForecast extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'data_for_forecast';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'station_id',
        'temperature',
        'pressure',
        'wind_speed',
        'wind_direction',
        'phenomena',
        'date',
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