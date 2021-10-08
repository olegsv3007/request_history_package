<?php

namespace Olegsv\History\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Olegsv\History\Repositories\RequestRepositoryInterface;

class StoreRequestInformationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(Request $request, $response)
    {
        $requestData = [
            'id' => uniqid(),
            'ip' => $request->ip(),
            'user_id' => $request->user()?->id ?? 0,
            'created_at' => Carbon::now(),
            'url' => $request->url(),
            'method' => $request->method(),
            'response_code' => $response->getStatusCode(),
        ];

        $this->getRequestRepository()->store($requestData);
    }

    private function getRequestRepository()
    {
        return app(RequestRepositoryInterface::class);
    }
}
