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
    public function handle($request, Closure $next, $role)
    {
        // $user = Auth::user();
        // // Periksa apakah pengguna telah login
        // if ($user->user()->status !== $role) {
        //     abort(403, 'Unauthorized action.');
        // }

        // return $next($request);
        // }

        // Jika pengguna tidak memiliki peran yang valid atau belum login,
        // Anda dapat mengarahkannya ke halaman tertentu atau memberikan respons sesuai kebutuhan.
       
        $user = Auth::user()->status;

        if (!$user || $user !== $role) {
            return redirect('dahsboard'); // Ganti '/' dengan rute halaman yang ingin ditampilkan ketika akses ditolak
        }

        return $next($request);
    

    
        // 

        // return $next($request);
    

    }
}