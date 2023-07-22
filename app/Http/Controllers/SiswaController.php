<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\View\View;
use Illuminate\Http\Request;
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

    public function detailSiswa($nomor_s, $title) {
        $data_siswa = Siswa::where('nomor_s', $nomor_s)->get();
        $user = Auth::user();
        if ($data_siswa) {
            return view('dataSiswaSekolah', compact('data_siswa', 'user', 'title'));
        } else {
            return response('Siswa tidak ditemukan', 404);
        }
    }

    public function dashboardSekolah($nomor_s, $title) {
        $data = Siswa::where('nomor_s', $nomor_s)->get();
        $user = Auth::user();
        if ($data) {
            return view('homeSekolah', compact('data', 'title', 'user'));
        } else {
            return response('Siswa tidak ditemukan', 404);
        }
    }
}
