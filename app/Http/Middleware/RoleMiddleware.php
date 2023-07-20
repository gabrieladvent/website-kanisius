<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request,Closure $next, $role1, $role2): Response
    // {
        
    //     if (!Auth::check() || !Auth::user()->hasRole([$role1, $role2])) {
    //         return redirect('/unauthorized');
    //     }
    //     return $next($request);
    // }
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna telah login
        if (Auth::check()) {
            // Periksa peran pengguna
            if (Auth::user()->status == "yayasan") {
                // Jika pengguna memiliki peran pertama, arahkan ke halaman A
                return response()->view('/dashboard');
                
            } elseif (Auth::user()->status == "sekolah") {
                // Jika pengguna memiliki peran kedua, arahkan ke halaman B
                return response()->view('/homesekolah');
            }
        }

        // Jika pengguna tidak memiliki peran yang valid atau belum login,
        // Anda dapat mengarahkannya ke halaman tertentu atau memberikan respons sesuai kebutuhan.
        return response()->view('');
    }

}
