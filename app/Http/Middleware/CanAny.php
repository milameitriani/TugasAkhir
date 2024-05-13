<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanAny
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$gates)
    {
        if (!in_array(user('role'), $gates)) {
            abort(403);
        }

        return $next($request);
    }
}
