<?php

namespace App\Models;

use App\Enums\PhenomenaTypes;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    /**
     * The custom attributes.
     *
     * @var array
     */
    protected $appends = [
        'image_url',
        'phenomena_name',
        'favorite',
        'wind_direction_name'
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
        'forecast_date',
        'is_confirmed'
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
            case PhenomenaTypes::Thunderstorm:
                return "/images/thunderstorm.png";
                break;
            default:
                return "/images/cloudy_day.png";
                break;
        }
    }

    public function getPhenomenaNameAttribute()
    {
        switch ($this->phenomena)
        {
            case PhenomenaTypes::Rain:
                return "Rain";
                break;
            case PhenomenaTypes::Snow:
                return "Snow";
                break;
            case PhenomenaTypes::Thunderstorm:
                return "Thunderstorm";
                break;
            default:
                return "Cloudy Day";
                break;
        }
    }

    public function getFavoriteAttribute()
    {
        if ($this->is_confirmed){
            return "favorite";
        } else {
            return "favorite_border";
        }
    }

    public function getWindDirectionNameAttribute()
    {
        return Helper::GetWindDirectionName($this->wind_direction);
    }
}