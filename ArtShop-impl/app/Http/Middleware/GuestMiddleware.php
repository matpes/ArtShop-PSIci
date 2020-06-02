<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;

class GuestMiddleware
{
    /*-----------------------------------------------------------------------------------------|
     |      Author: Samardžija Sanja 17/0372                                                   |
     |-----------------------------------------------------------------------------------------|
     |      Preusmeravanje zahteva koji su dostupni samo gostu                                 |
     |-----------------------------------------------------------------------------------------|
     |      U slučaju da korisnik koji nije gost pokuša da pristupi nekoj ruti preusmerava se  |
     |      na početnu stranicu svog naloga.                                                               |
     |                                                                                         |
     |-----------------------------------------------------------------------------------------|
     */

    public function handle($request, Closure $next)
    {
        if (Auth::check())
            return response()->redirectToRoute('profile.user', ['id'=>Auth::id()]);
        return $next($request);
    }
}
