<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    /*-----------------------------------------------------------------------------------------|
     |      Author: Samardžija Sanja 17/0372                                                   |
     |-----------------------------------------------------------------------------------------|
     |      Preusmeravanje zahteva koji su dostupni samo gostu                                 |
     |-----------------------------------------------------------------------------------------|
     |      U slučaju da korisnik koji nije gost pokuša da pristupi nekoj ruti preusmerava se  |
     |      na početnu stranicu.                                                               |
     |                                                                                         |
     |-----------------------------------------------------------------------------------------|
     */

    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            return redirect('home')._("Ova stranica je dostupna samo gostima, izlogujte se i probajte ponovo!");
        }
        return $next($request);
    }
}
