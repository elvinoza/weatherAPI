<?php

namespace App\Services;

use App\Models\Forecast;
use App\Models\User;

interface IForecastService
{
    function calculateForecast();
    function getAllStationForecasts($stationId);
    function getUserStationsForecast($id);
    function getForecast($id);
}

class ForecastService implements IForecastService
{
    protected $user;
    protected $forecast;

    public function __construct(User $user, Forecast $forecast)
    {
        $this->user = $user;
        $this->forecast = $forecast;
    }

    public function calculateForecast()
    {
        // TODO: Implement calculateForecast() method.
    }

    public function getAllStationForecasts($stationId)
    {
        return $this->forecast->where('station_id', '=', $stationId)->get();
    }

    function getUserStationsForecast($id)
    {
        return $this->user->stations();
    }

    function getForecast($id)
    {
        return $this->forecast->find($id);
    }
}