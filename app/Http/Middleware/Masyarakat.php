<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Masyarakat
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
        if(Auth::user()->level != "masyarakat"){
            abort(404);
        }
        return $next($request);
    }
}
