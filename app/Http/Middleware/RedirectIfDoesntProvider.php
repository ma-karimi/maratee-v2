<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfDoesntProvider
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'provider')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('/panel/provider');
        }

        return $next($request);
    }
}
