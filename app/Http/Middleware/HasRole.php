<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Response;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if (Auth::user() && Auth::user()->hasRole($role)) {
            return $next($request);
        }

        return abort(Response::HTTP_UNAUTHORIZED);
    }
}
