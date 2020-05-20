<?php

namespace App\Http\Middleware;

use App\Kupac;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class KupacMiddleware
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
        $korid = Auth::id();
        if(Kupac::find($korid) == null) {
            return redirect('home');
        }
        return $next($request);
    }
}
