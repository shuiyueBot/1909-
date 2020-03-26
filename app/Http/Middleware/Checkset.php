<?php

namespace App\Http\Middleware;

use Closure;

class Checkset
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
        $adminuser=$request->session()->get("login");
        if(!$adminuser){
            return redirect("/");
        }
        return $next($request);
    }
 }

