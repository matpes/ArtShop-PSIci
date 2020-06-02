<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlikarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            if (!Auth::user()->isSlikar)
                return response()->redirectToRoute('profile.user', ['id'=>Auth::id()]);
        } else
            return response()->redirectToRoute('home');

        return $next($request);
    }
}
