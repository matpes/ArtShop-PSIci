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
     |      na početnu stranicu.                                                               |
     |                                                                                         |
     |-----------------------------------------------------------------------------------------|
     */

    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            $slike = array();
            return response()->view('profile.user', ['user'=>Auth::user(), 'slike'=>$slike, ]);
        }
        return $next($request);
    }
}
