<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class UserMiddleware
{
    /*-----------------------------------------------------------------------------------------|
     |      Author: Samardžija Sanja 17/0372                                                   |
     |-----------------------------------------------------------------------------------------|
     |      Preusmeravanje zahteva koji su dostupni samo korisniku                             |
     |-----------------------------------------------------------------------------------------|
     |      U slučaju da korisnik koji nije ulogovan i pokuša da pristupi nekoj ruti           |
     |      preusmerava se na formu za prijavu na sistem.                                      |
     |                                                                                         |
     |-----------------------------------------------------------------------------------------|
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check())
            response()->view('auth.login');

        return $next($request);
    }
}
