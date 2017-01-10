<?php

namespace App\Services;

use App\Models\RequestLog;

interface IRequestLoggerService
{
    function getAllRequests();
}

class RequestLoggerService implements IRequestLoggerService
{
    protected $requestLog;

    public function __construct(RequestLog $requestLog)
    {
        $this->requestLog = $requestLog;
    }

    public function getAllRequests()
    {
        return $this->requestLog->all();
    }
}