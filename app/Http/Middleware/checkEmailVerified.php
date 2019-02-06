<?php

namespace App\Http\Middleware;

use Closure;

class checkEmailVerified
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
        return auth()->user() && (auth()->user()->status == 1) ? $next($request) : redirect('/register')->with('message', "your email has not been verified, please check your email");
    }
}
