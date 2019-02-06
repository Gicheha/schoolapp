<?php

namespace App\Http\Middleware;

use Closure;

class checkTeachers
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
        return auth()->user() && (auth()->user()->role != 'Admin') ? $next($request) : redirect('home')->with('message', "you are not allowed to access those resources");
    }
}
