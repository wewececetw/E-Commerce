<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('utype') === "USR") {

            return $next($request);

        }  
        
        if(session('utype') === "ADM") {

            return redirect()->route('home');
            
        } 
            session()->flush();
            return redirect()->route('login');

    }
}
