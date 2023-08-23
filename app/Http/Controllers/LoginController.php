<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use App\Models\Siswa;
use App\Models\Sekolah;
use App\Models\Siswa_TK;
use App\Models\Yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /*
        Method untuk menampilkan halaman login
    */
    public function index()
    {
        $poto = DB::table('yayasan')->first();
        return view('auth.login', compact('poto'));
    }

    /*
        Method untuk menampilkan dashboard berdasarkan user yang login 
    */
    public function dashboard($title, Request $request)
    {
        try {
            $poto = DB::table('yayasan')->first();
            $user = Auth::user();
            $dataSekolah = Sekolah::all();
            $kirim = Kirim::all();
            $sekolah = Sekolah::where('NOMOR_S', $user->id)->value('NAMASEKOLAH');
            $temp = Sekolah::where('NOMOR_S', $user->id)->value('NOMOR_S');

            /*
                Jika yang login mempunyai status berupa yayasan, maka akan dibawa ke dashboard yayasan. dan sebaliknya validasi dengan nama sekolah yang ada di sekolah
            */
            // dd($sekolah);
            if ($user->status == 'sekolah' && $user->namasekolah == $sekolah) {
                $sekolahId = $user->id;
                return $this->sekolah($sekolahId);
            } elseif($user->status == 'yayasan') {
                return view('dashboard', compact('kirim', 'user', 'title', 'dataSekolah'));
            } else{
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return view('auth.login', compact('poto'));
            }
        } catch (\Exception $e) {
            abort(401, 'Silahkan Melakukan Login Terlebih Dahulu');
        }
    }

    public function sekolah($sekolahId)
    {
        $user = Auth::user();
        $isTK = $user->namasekolah;
        $data = Siswa::where('nomor_s', $sekolahId)->paginate(5);
        $TK = Siswa_TK::where('NOMOR_S', $sekolahId)->paginate(5);
        return view('homeSekolah', compact('user', 'isTK', 'TK', 'data'));
    }

    /*
        Method untuk mengeksekusi permintaan logout
    */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect('/');
    }
}
