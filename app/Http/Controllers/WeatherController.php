<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
        $this->weatherService = $weatherService;
    }

    public function getWeather($id)
    {
        return $this->weatherService->getWeather($id);
    }
}
