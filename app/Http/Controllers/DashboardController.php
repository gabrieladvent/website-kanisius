<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Implementasi kode untuk menampilkan dashboard
        return view('dashboard');
    }

    public function getNotifikasi()
    {
        $notifikasi = Kirim::latest()->take(2)->get();
        $user = Auth::user();
        $users = User::pluck('namasekolah', 'id');
       // dd($users, $notifikasi);

        return view('dashboard', compact('notifikasi', 'users', 'user'));
    }

    // Tambahan metode lainnya sesuai dengan kebutuhan

    public function showNotifikasi()
{
    $notifikasi = Kirim::all();
    $users = User::pluck('namasekolah', 'id');

    return view('notifikasi', compact('notifikasi', 'users'));
}

}

