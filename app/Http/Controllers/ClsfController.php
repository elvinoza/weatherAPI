<?php

namespace App\Http\Controllers;

use App\Services\ClsfWeatherParameterService;

class ClsfController extends Controller
{
    protected $clsfWeatherParameterService;

    public function __construct(ClsfWeatherParameterService $clsfWeatherParameterService)
    {
        $this->middleware('jwt.auth');
        $this->clsfWeatherParameterService = $clsfWeatherParameterService;
    }

    public function getAllParameters()
    {
        return $this->clsfWeatherParameterService->getAll();
    }
}