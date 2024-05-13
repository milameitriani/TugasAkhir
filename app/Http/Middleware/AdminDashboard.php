<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->cannot('admin')) {
            return redirect()->route('admin.orders.index');
        }

        return $next($request);
    }
}
