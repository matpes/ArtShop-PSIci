<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class UserMiddleware
{
    /**
     * Author: Samardžija Sanja 17/0372
     *          --- Preusmeravanje zahteva koji su dostupni samo registrovanom korisniku ----
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() == false)
        {
            return response()->view('auth.login');
        }

        return $next($request);
    }
}
