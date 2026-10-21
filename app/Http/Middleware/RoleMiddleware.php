<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role user yang login sesuai dengan role yang diminta
        if (Auth::user()->role !== $role) {
            // Jika bukan rolenya, batasi akses
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Jika sesuai, lanjutkan request
        return $next($request);
    }
}