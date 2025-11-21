<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SellerMustHaveBusiness
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->hasRole('seller') && !$user->business) {

            if (!$request->routeIs('seller.business.create') &&
                !$request->routeIs('seller.business.store')) {

                return redirect()->route('seller.business.create')
                    ->with('warning', 'Debes crear tu negocio antes de continuar.');
            }
        }

        return $next($request);
    }
}
