<?php

namespace App\Services;

use App\Models\Weather;
use App\Models\Station;

interface IWeatherService
{
    function getWeather($id);
    function createWeather($data);
    function getWeathers($request);
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

        //Response for station
        return response(['success' => true], 200);
    }

    public function getWeathers($request)
    {
        $data = $this->weather
            ->where('station_id','=', $request->station_id)
            ->whereBetween('created_at',[$request->startDate, $request->endDate])
            ->get();

        return [
            'humidity' => $this->humidity($data),
            'temperature' => $this->temperatures($data),
            'pressure' => $this->pressure($data),
            'soil_temperature' => $this->soil_temperature($data),
            'soil_humidity' => $this->soil_humidity($data),
            'wind_speed' => $this->wind_speed($data),
            'wind_direction' => $this->wind_direction($data),
            'rain' => $this->rain($data),
            'time' => $this->time($data)
        ];
    }

    private function temperatures($data)
    {
        return $data->map(function($weather) {
            return $weather->temperature;
        });
    }

    private function humidity($data)
    {
        return $data->map(function($weather) {
            return $weather->humidity;

        });
    }

    private function pressure($data)
    {
        return $data->map(function($weather) {
            return $weather->pressure;

        });
    }

    private function soil_temperature($data)
    {
        return $data->map(function($weather) {
            return $weather->soil_temperature;

        });
    }

    private function soil_humidity($data)
    {
        return $data->map(function($weather) {
            return $weather->soil_humidity;

        });
    }

    private function wind_speed($data)
    {
        return $data->map(function($weather) {
            return $weather->wind_speed;

        });
    }

    private function wind_direction($data)
    {
        return $data->map(function($weather) {
            return $weather->wind_direction;

        });
    }

    private function rain($data)
    {
        return $data->map(function($weather) {
            return $weather->rain;

        });
    }

    private function time($data)
    {
        return $data->map(function($weather) {
            return $weather->created_at->toDateTimeString();

        });
    }
}