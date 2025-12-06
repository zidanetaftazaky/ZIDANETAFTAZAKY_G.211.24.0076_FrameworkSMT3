<?php

namespace App\Http\Controllers\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // Jika BELUM login → lanjutkan ke halaman login
        if (! Auth::check()) {
            return $next($request);
        }

        // Jika SUDAH login → langsung ke perpus
        return redirect('/perpus');
    }
}
