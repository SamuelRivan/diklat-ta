<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AkpkMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('pegawais')->check()) {
            return redirect()->route('login.akpk'); // Redirect to AKPK login if not logged in
        }

        return $next($request);
    }
}
