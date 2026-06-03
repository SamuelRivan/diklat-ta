<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah pegawai sudah login menggunakan guard 'pegawais'
        if (!Auth::guard('pegawais')->check()) {
            // Jika belum login, redirect ke halaman login pegawai
            return redirect()->route('pegawai.login');
        }

        return $next($request);
    }
}

