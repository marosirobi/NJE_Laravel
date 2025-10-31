<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // 1. Be van jelentkezve EGYÁLTALÁN?
    // 2. A bejelentkezett felhasználó 'role'-ja 'admin'?
    if (Auth::check() && Auth::user()->role == 'admin') {
        // Igen, továbbmehet a kért oldalra (ez a VIP részleg)
        return $next($request);
    }

    // Ha nem admin, visszaküldjük a főoldalra egy hibaüzenettel.
    return redirect('/dashboard')->with('error', 'Nincs jogosultságod megtekinteni ezt az oldalt.');
}
}
