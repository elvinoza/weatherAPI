<?php

namespace App\Models;

use App\Enums\ClsfWeatherParameters;
use App\Enums\PhenomenaTypes;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    /**
     * The custom attributes.
     *
     * @var array
     */
    protected $appends = [
        'image_url'
    ];

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
        'pressure',
        'wind_speed',
        'wind_direction',
        'phenomena',
        'forecast_date'
    ];

    public function station()
    {
        return $this->belongsTo('App\Models\Station');
    }

    public function getImageUrlAttribute()
    {
        switch ($this->phenomena)
        {
            case PhenomenaTypes::Rain:
                return "/images/rain.png";
                break;
            case PhenomenaTypes::Snow:
                return "/images/snow.png";
                break;
            default:
                return "/images/thunderstorm.png";
                break;
        }
    }
}