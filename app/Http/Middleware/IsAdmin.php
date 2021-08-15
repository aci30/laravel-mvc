<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // web admin
        if (Auth::user() && Auth::user()->name === 'admin'){
            return $next($request);
        }

        // api admin
        if (Auth::user()->currentAccessToken() && Auth::user()->currentAccessToken()->name === 'admin_token'){
            return $next($request);
        }
    
        abort(403, 'Access denied');
    }
}
