<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthAdmin
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
        if (! Auth::user())
        {
            return route('login');
        }
        else
        {
            if (Auth::user()->user_type != 'Admin')
                return redirect('home');
        }
        return $next($request);
    }
}
