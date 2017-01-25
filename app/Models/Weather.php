<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Weather extends Model {

    /**
     * The custom attributes.
     *
     * @var array
     */
    protected $appends = [
        'wind_direction_name'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'weathers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'station_id', 'temperature', 'humidity', 'pressure', 'soil_temperature', 'soil_humidity', 'wind_speed',
        'wind_direction', 'rain'
    ];

    /**
     * Many to one relation
     *
     * @return Illuminate\Database\Eloquent\Relations\belongTo
     */
    public function station()
    {
        return $this->belongsTo("App\Models\Station");
    }

    public function getWindDirectionNameAttribute()
    {
        return Helper::GetWindDirectionNameByDegree($this->wind_direction);
    }
}