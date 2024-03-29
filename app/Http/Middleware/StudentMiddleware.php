<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class StudentMiddleware
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
            return $next($request);
        }

        if(Auth::user()->role == 'administrative assist'){
            return redirect()->route('administrative');
        }

        if(Auth::user()->role == 'advisor'){
            return redirect()->route('student');
        }

    }
}
