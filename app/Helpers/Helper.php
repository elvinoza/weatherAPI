<?php

namespace App\Helpers;

use App\Enums\ClsfWeatherParameters;
use App\Enums\WindDirectionFromRussian;
use App\Enums\WindDirections;
use App\Enums\PhenomenaTypes;

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

    public static function ParseWindParameters($windString)
    {
        if (substr_count($windString, ' ') == 0)
        {
            return ['dir' => null, 'speed' => null];
        }

        $windString = preg_split('/\s+/', $windString);

        switch ($windString[0]) {
            case WindDirectionFromRussian::North:
                $direction = WindDirections::North;
                break;
            case WindDirectionFromRussian::NorthEast:
                $direction = WindDirections::NorthEast;
                break;
            case WindDirectionFromRussian::East:
                $direction = WindDirections::East;
                break;
            case WindDirectionFromRussian::SouthEast:
                $direction = WindDirections::SouthEast;
                break;
            case WindDirectionFromRussian::South:
                $direction = WindDirections::South;
                break;
            case WindDirectionFromRussian::SouthWest:
                $direction = WindDirections::SouthWest;
                break;
            case WindDirectionFromRussian::West:
                $direction = WindDirections::West;
                break;
            default:
                $direction = WindDirections::NorthWest;
                break;
        }

        return ['dir' => $direction, 'speed' => filter_var($windString[1], FILTER_SANITIZE_NUMBER_INT) ];
    }

    public static function ParsePhenomena($phenomena)
    {
        if (strpos($phenomena, 'storm') !== false) {
            return PhenomenaTypes::Thunderstorm;
        }

        if (strpos($phenomena, 'rain') !== false) {
            return PhenomenaTypes::Rain;
        }

        return PhenomenaTypes::Snow;
    }

    public static function FormatNotificationMessage($stationName, $value, $parameter, $unit)
    {
        return "Now in " . $stationName ." " . $parameter . " is " . $value. " " . $unit . ".";
    }

    public static function CompareDatesForNotification($notificationDate)
    {
        if ($notificationDate != null)
        {
            $hourDiff = round((strtotime(date("Y-m-d H:m:s")) - strtotime($notificationDate))/3600, 1);
            if ($hourDiff > 24)
                return true;

            return false;
        }

        return true;
    }

    public static function GetWindDirectionName($id)
    {
        switch ($id)
        {
            case WindDirections::East:
                return "East";
                break;
            case WindDirections::North:
                return "North";
                break;
            case WindDirections::NorthEast:
                return "North East";
                break;
            case WindDirections::NorthWest:
                return "North West";
                break;
            case WindDirections::South:
                return "South";
                break;
            case WindDirections::SouthEast:
                return "South East";
                break;
            case WindDirections::SouthWest:
                return "South West";
                break;
            case WindDirections::West:
                return "West";
                break;
            default:
                return "NF";
                break;
        }
    }
}