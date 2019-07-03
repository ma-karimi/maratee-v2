<?php

namespace App\Http\Middleware;

use Closure;

class GuardCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $guard = $request->is('api\*') ? 'api' : 'web';
        $request->merge(['guard' => $guard]);
        return $next($request);
    }
}
