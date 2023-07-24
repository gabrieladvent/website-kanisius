<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showNotifikasi($title)
    {
        $notifikasi = Kirim::all();
        $users = User::pluck('namasekolah', 'id');

        return view('notifikasi', compact('notifikasi', 'users', 'title'));
    }

    public function profile(Request $request, $title) {
        $user = Auth::user();
        return view('profileYayasan', compact('user', 'title'));
    }
}
