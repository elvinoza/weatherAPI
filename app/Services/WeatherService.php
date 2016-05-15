<?php

namespace App\Services;

use App\Models\Weather;
use App\Models\Station;

interface IWeatherService
{
    function getWeather($id);
    function createWeather($data);
}

class WeatherService implements IWeatherService
{
    protected $weather;
    protected $station;

    public function __construct(Weather $weather, Station $station)
    {
        $this->weather = $weather;
        $this->station = $station;
    }

    public function getWeather($id)
    {
        return $this->weather->find($id);
    }

    public function createWeather($data)
    {
        $weather = new Weather();
        $weather->station_id = $data->station_id;
        $weather->temperature = $data->temperature;
        $weather->humidity = $data->humidity;
        $weather->pressure = $data->pressure;
        $weather->soil_temperature = $data->soil_temperature;
        $weather->soil_humidity = $data->soil_humidity;
        $weather->wind_speed = $data->wind_speed;
        $weather->wind_direction = $data->wind_direction;
        $weather->rain = $data->rain;
        $weather->save();
        return response(['success' => true], 200);
    }
}