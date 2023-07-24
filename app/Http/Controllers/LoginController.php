<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function dashboard($title)
    {
        $user = Auth::user();
        $notifikasi = Kirim::with('user')->latest()->take(2)->get();
        $users = User::pluck('namasekolah', 'id');

        if ($user->status == 'sekolah') {
            $sekolahId = $user->id;
            return $this->sekolah($sekolahId);
        } else {
            return view('dashboard', compact('notifikasi', 'users', 'user', 'title'));
        }
    }

    public function sekolah($sekolahId)
    {
        $user = Auth::user();
        $data = Siswa::where('nomor_s', $sekolahId)->get();
        return view('homeSekolah', compact('user', 'data'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
