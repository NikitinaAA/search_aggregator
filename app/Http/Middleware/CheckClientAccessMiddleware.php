<?php

namespace App\Http\Middleware;

use App\Facades\ClientRepository;
use Closure;
use ErrorException;
use Illuminate\Http\Request;

class CheckClientAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     * @throws ErrorException
     */
    public function handle($request, Closure $next)
    {
        $token = $request->route('token');
        $client = ClientRepository::findByToken($token);

        if (!$client->available_requests_number) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
