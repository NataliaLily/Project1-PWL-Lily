<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PWLAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        #cek apakah user yang sedang login, role admin atau bukan,
        #kalau bukan, kita return 403, kalau ya lanjutkan saja
        if (\Auth::user()->role === "user") {
            abort(403);
        }
        #melanjutkan request
        return $next($request);
    }
}

