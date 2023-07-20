<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index(){ 
        $siswa = Siswa::all();
        // Lakukan eager loading untuk data sekolah terkait
        $data_siswa = $siswa->load('sekolah');
        return view('tabeluseryayasan', compact('data_siswa'));
    }

    public function detailSiswa($nomor_s) {
        $data_siswa = Siswa::where('nomor_s', $nomor_s)->get();

        if ($data_siswa) {
            return view('dataSiswaSekolah', compact('data_siswa'));
        } else {
            return response('Siswa tidak ditemukan', 404);
        }
    }

    public function dashboardSekolah($nomor_s) {
        $data = Siswa::where('nomor_s', $nomor_s)->get();
        

        if ($data) {
            return view('homeSekolah', compact('data'));
        } else {
            return response('Siswa tidak ditemukan', 404);
        }
    }
}
