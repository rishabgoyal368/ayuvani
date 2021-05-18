<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Chemist;
class CheckChemistAuth
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
        if(!Auth::guard('chemist')->user()){    
            return redirect('chemist/login')->with('error','Please login first');
        }
        return $next($request);
    }
}
