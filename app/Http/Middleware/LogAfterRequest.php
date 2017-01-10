<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\TerminableInterface;
use App\Models\RequestLog;

class LogAfterRequest implements TerminableInterface
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response)
    {
        $requestLog = new RequestLog();
        $requestLog->ip = $request->getClientIp();
        $requestLog->uri = $request->getRequestUri();
        $requestLog->save();
    }
}