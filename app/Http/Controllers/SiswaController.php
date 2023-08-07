<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;   
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index($title){ 
        $user = Auth::user();
        $siswa = Siswa::all();
        // Lakukan eager loading untuk data sekolah terkait
        $data_siswa = $siswa->load('sekolah');
        return view('tabeluseryayasan', compact('data_siswa', 'title', 'user'));
    }
    

    public function detailSiswa($slug, $title) {
        // Dapatkan id siswa berdasarkan slug dari tabel User
        $id = User::where('slug', $slug)->value('id');
    
        // Dapatkan siswa-siswa dari tabel siswa yang memiliki nomor_s yang sama dengan id
        $data = Siswa::where('nomor_s', $id)->get();
    
        $user = Auth::user();
        if ($data) {
            return view('dataSiswaSekolah', compact('data', 'user', 'title'));
        } else {
            return response('Siswa tidak ditemukan', 404);
        }
    }

    public function dashboardSekolah($slug, $title) {
        // Dapatkan id siswa berdasarkan slug dari tabel User
        $id = User::where('slug', $slug)->value('id');
    
        // Dapatkan siswa-siswa dari tabel siswa yang memiliki nomor_s yang sama dengan id
        $data = Siswa::where('nomor_s', $id)->paginate(5);
    
        $user = Auth::user();
    
        if ($data) {
            return view('homeSekolah', compact('data', 'title', 'user'));
        } else {
            return response('Siswa tidak ditemukan', 404);
        }
    }
    
}
