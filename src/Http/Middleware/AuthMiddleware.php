<?php

namespace JeroenvanRensen\MoonPHP\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  \Closure                 $next
    *
    * @return mixed
    */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('moon')->check()) {
            return redirect(route('moon.auth.login'));
        }

        return $next($request);
    }
}
