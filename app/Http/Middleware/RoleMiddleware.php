<?php
//
//namespace App\Http\Middleware;
//
//use Closure;
//use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Response;
//
//class RoleMiddleware
//{
//    public function handle(Request $request, Closure $next, string $role): Response
//    {
//        if ($request->user() && $request->user()->role === $role) {
//            return $next($request);
//        }
//
//        abort(403, 'Unauthorized action.');
//    }
//}


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Kalau belum login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Kalau role tidak cocok → langsung ke login lagi
        if ($request->user()->role !== $role) {
            return redirect()->route('login')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk halaman ini.');
        }

        // Jika role sesuai, lanjutkan
        return $next($request);
    }
}
