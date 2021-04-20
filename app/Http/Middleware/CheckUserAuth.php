<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class CheckUserAuth
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
            return redirect('user/login')->with('error','Please login first');
        }
        return $next($request);
    }
}
