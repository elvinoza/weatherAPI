<?php

namespace App\Services;

use App\Models\Weather;

interface IWeatherService
{
    function getWeather($id);
}

class WeatherService implements IWeatherService
{
    protected $weather;

    public function __construct(Weather $weather)
    {
        $this->weather = $weather;
    }

    public function getWeather($id)
    {
        return $this->weather->find($id);
    }
}