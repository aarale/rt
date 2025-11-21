<?php

namespace App\Http\Middleware;

use Closure;

class SetUserMode
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (auth()->check() && !session()->has('mode')) {
            if (auth()->user()->hasRole('seller')) {
                session(['mode' => 'seller']);
            } elseif (auth()->user()->hasRole('customer')) {
                session(['mode' => 'customer']);
            }
        }

        return $response;
    }
}

