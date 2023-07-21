<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function dashboard() {
        $user = Auth::user();
        if($user->status == 'sekolah'){
            $sekolahId = $user->id;
            return redirect()->route('sekolah', ['nomor_s' => $sekolahId]);
        } else{
            return view('dashboard', compact('user'));
        }
    }

    public function logout(Request $request): RedirectResponse
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/login');
}
   

}
