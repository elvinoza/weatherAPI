<?php

namespace App\Services;

use App\Models\Forecast;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
         $forecasts = DB::table('users')
                        ->leftJoin('stations', 'users.id', '=', 'stations.user_id')
                        ->leftJoin('forecast', 'stations.id', '=', 'forecast.station_id')
                        ->where('users.id', '=', $id)
                        ->where('forecast.forecast_date', '>=', Carbon::now()->toDateString())
                        ->select('stations.id', 'stations.name', 'forecast.*')
                        ->get();

        return $forecasts;
    }

    function getForecast($id)
    {
        return $this->forecast->find($id);
    }
}