<?php

namespace App\Http\Controllers;

use App\Services\ForecastService;

class ForecastController extends Controller
{
    protected $forecastService;

    public function __construct(ForecastService $forecastService)
    {
        $this->middleware('jwt.auth', ['except' => ['getDataFromGisMeteo']]);
        $this->forecastService = $forecastService;
    }

    public function getUserStationsForecasts($id)
    {
        return $this->forecastService->getUserStationsForecast($id);
    }

    public function getForecast($id)
    {
        return $this->forecastService->getForecast($id);
    }

    public function getAllStationForecasts($id)
    {
        return $this->forecastService->getAllStationForecasts($id);
    }

    public function getDataFromGisMeteo()
    {
        return $this->forecastService->getDataFromGisMeteo();
    }
}