<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use App\Models\Yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showNotifikasi($title)
    {
        $notifikasi = Kirim::all();
        $users = User::pluck('namasekolah', 'id');

        return view('notifikasi', compact('notifikasi', 'users', 'title'));
    }

    public function profile(Request $request) {
            $user = Auth::user();
        if ($user->status == 'sekolah') {
            $sekolahId = $user->id;
            return $this->sekolah($sekolahId);
        } else {
            $title = "Profile Yayasan";
            return view('profileYayasan', compact('user','title'));
        }   
    }

    public function sekolah($sekolahId)
    {
        $user = Auth::user();
        $title = "Profile Sekolah";
        return view('profileSekolah', compact('user', 'title'));
    }
}