<?php

namespace App\Http\Controllers;

use App\Services\RequestLoggerService;

class RequestLoggerController extends Controller
{
    protected $requestLoggerService;

    public function __construct(RequestLoggerService $requestLoggerService)
    {
        $this->middleware('jwt.auth');
        $this->requestLoggerService = $requestLoggerService;
    }

    public function getLogs()
    {
        return $this->requestLoggerService->getAllRequests();
    }
}