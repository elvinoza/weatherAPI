<?php

namespace App\Http\Controllers;

use App\Http\Requests\Weather\FilterWeathersRequest;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->middleware('jwt.auth', ['except' => ['getWeathers']]);
        $this->weatherService = $weatherService;
    }

    public function getWeather($id)
    {
        return $this->weatherService->getWeather($id);
    }

    public function getWeathers(FilterWeathersRequest $request)
    {
        return $this->weatherService->getWeathers($request);
    }
}
