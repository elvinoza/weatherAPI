<?php

namespace App\Http\Controllers;

use App\Http\Requests\Forecast\FilterForecastRequest;
use App\Services\ForecastService;

class ForecastController extends Controller
{
    protected $forecastService;

    public function __construct(ForecastService $forecastService)
    {
        $this->middleware('jwt.auth', ['except' => ['getDataFromGisMeteo', 'calculateForecast', 'getForecasts']]);
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

    public function getForecasts(FilterForecastRequest $request)
    {
        return $this->forecastService->getForecasts($request->startDate, $request->endDate);
    }

    public function getAllStationForecasts($id)
    {
        return $this->forecastService->getAllStationForecasts($id);
    }

    public function calculateForecast($id)
    {
        return $this->forecastService->calculateForecast($id);
    }

    public function getDataFromGisMeteo()
    {
        $this->forecastService->getDataFromGisMeteo();
    }
}