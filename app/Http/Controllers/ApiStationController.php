<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use App\Http\Requests\ApiStation\CreateWeatherRequest;

class ApiStationController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function createWeather(CreateWeatherRequest $request){
        $this->weatherService->createWeather($request);
    }
}