<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use App\Models\Siswa;
use App\Models\Sekolah;
use App\Models\Yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index()
    {
        $poto = DB::table('yayasan')->first();
        return view('auth.login', compact('poto'));
    }

    public function dashboard($title)
    {
        try {
            $user = Auth::user();
            $notifikasi = Kirim::with('user')->get();
            $users = User::pluck('namasekolah', 'id');
            $dataSekolah = Sekolah::all();

            if ($user->status == 'sekolah') {
                $sekolahId = $user->id;
                return $this->sekolah($sekolahId);
            } else {
                return view('dashboard', compact('notifikasi', 'users', 'user', 'title', 'dataSekolah'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', 'Gagal Login. Silahkan Login Ulang');
        }
    }

    public function sekolah($sekolahId)
    {
        $user = Auth::user();
        $data = Siswa::where('nomor_s', $sekolahId)->paginate(5);
        return view('homeSekolah', compact('user', 'data'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
