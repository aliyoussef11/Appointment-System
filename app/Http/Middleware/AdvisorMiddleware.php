<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdvisorMiddleware
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
        if(!Auth::check()){
            return redirect()->route('login');
        }

        if(Auth::user()->role == 'student'){
            return redirect()->route('student');
        }

        if(Auth::user()->role == 'administrativeassist'){
            return redirect()->route('administrative');
        }

        if(Auth::user()->role == 'advisor'){
            return $next($request);
        }

    }
}
