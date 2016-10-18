<?php

namespace App\Helpers;

use App\Enums\ClsfWeatherParameters;

class Helper
{
    public static function ResolveWeatherParameter($clsfWeatherParameter){
        $parameter = "";

        switch ($clsfWeatherParameter) {
            case ClsfWeatherParameters::Temperature:
                $parameter = 'temperature';
                break;
            case ClsfWeatherParameters::Humidity:
                $parameter = 'humidity';
                break;
            case ClsfWeatherParameters::Pressure:
                $parameter = 'pressure';
                break;
            case ClsfWeatherParameters::SoilTemperature:
                $parameter = 'soil_temperature';
                break;
            case ClsfWeatherParameters::SoilHumidity:
                $parameter = 'soil_humidity';
                break;
            case ClsfWeatherParameters::WindSpeed:
                $parameter = 'wind_speed';
                break;
            case ClsfWeatherParameters::WindDirection:
                $parameter = 'wind_direction';
                break;
            case ClsfWeatherParameters::Rain:
                $parameter = 'rain';
                break;
        }

        return $parameter;
    }
}