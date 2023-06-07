<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Admin
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
       // return $next($request);
         if(Auth::check())
        {
            if(Auth::user()->user_type == '1')//here "1" is admin and "0" is commen user
            {
                 return $next($request);

            }
            else{
                 return redirect('/');
            }
        }
        else{
            return redirect('/');
        }
    }
}
