<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use App\Services\StationService;
use App\Http\Requests\ApiStation\CreateWeatherRequest;

class ApiStationController extends Controller
{
    protected $weatherService;
    protected $stationService;

    public function __construct(WeatherService $weatherService, StationService $stationService)
    {
        $this->weatherService = $weatherService;
        $this->stationService = $stationService;
    }

    public function createWeather(CreateWeatherRequest $request){
        return $this->weatherService->createWeather($request);
    }

    public function getStationUpdateTime($id)
    {
        return $this->stationService->getStationUpdateTime($id);
    }
}