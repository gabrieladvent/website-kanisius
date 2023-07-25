<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showNotifikasi($title)
    {
        $user = Auth::user();
        if ($user->status === 'sekolah'){
            $getNotifikasi = Kirim::where('ID', $user->id)->get();
            $notifikasi = [];
            
            foreach ($getNotifikasi as $notif) {
                $tanggal = Carbon::parse($notif->created_at)->format('Y-m-d');
                $waktu = Carbon::parse($notif->created_at)->format('H:i:s');
                $notifikasi[] = [
                    'nama_file' => $notif->nama_file,
                    'komentar' => $notif->Komentar,
                    'tanggal' => $tanggal,
                    'waktu' => $waktu,
                ];
            }
            return view('notifikasi', compact('notifikasi', 'title', 'user'));

        } else{
            $notifikasi = Kirim::all();
            $users = User::pluck('namasekolah', 'id');
            return view('notifikasi', compact('notifikasi', 'users', 'title', 'user'));
        }
    }

    public function profile(Request $request) {
        $user = Auth::user();
        if ($user->status == 'sekolah') {
            $sekolahId = $user->id;
            return $this->Profilsekolah($sekolahId);
        } else {
            $title = "Profile Yayasan";
            return view('profileYayasan', compact('user', 'title'));
        }   
    }

    public function Profilsekolah($sekolahId)
    {
        $user = Auth::user();
        $title = "Profile Sekolah";
        return view('profileSekolah', compact('user', 'title'));
    }
}
