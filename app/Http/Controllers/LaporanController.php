<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;   
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function laporan($title)
    {
    $user = Auth::user();
    $siswa = Siswa::all();
    // Lakukan eager loading untuk data sekolah terkait
    $data_siswa = $siswa->load('sekolah');
    $sekolah = Sekolah::all();
    return view('laporan', compact('data_siswa', 'sekolah', 'title', 'user'));
   
    }
    
    public function laporanFilter(Request $request, $title)
    {
        return $request->all();
    }

    //laporanType : Agama
    public function laporanAgama(Request $request, $title)
    {
        $user = Auth::user();

        // Bangun kueri dasar untuk mengambil model Siswa dengan relasi sekolah yang sudah dimuat eager
        $query = Siswa::with('sekolah');

        // Filter data siswa berdasarkan kriteria yang dipilih
        if ($request->has('namaSekolah')) {
            $query->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', $request->namaSekolah);
            });
        }

        if ($request->has('namaSekolah')){
            $kelasSD = $request->input('kelasSD');
            $detailKelas = $request->input('detailKelas');
            $rombelSetIni = $kelasSD . '' . $detailKelas;
            $query->where('Rombel_Set_Ini', $rombelSetIni);
        }

        $results = $query-> get();

        // // Filter berdasarkan kelasSD dan detailKelas
        // $kelasSD = $request->input('kelasSD');
        // $detailKelas = $request->input('detailKelas');
        // $rombelSetIni = $kelasSD . '' . $detailKelas;
        // $query->where('Rombel_Set_Ini', $rombelSetIni);
        

        // Dapatkan hasil kueri akhir
        $data_siswa = $query->get();

        // Dapatkan model-model Sekolah
        $sekolah = Sekolah::all();

        // Kembalikan tampilan dengan data yang sudah difilter
        // return view('laporan', compact('data_siswa', 'sekolah', 'title', 'user'));
        return view('laporan', compact('results', 'data_siswa', 'sekolah', 'title', 'user'));

    }

    // cetak laporan (Download)
    public function cetakLaporan(Request $request, $title){
        return $request->all();
    }


    // ShowTable
    public function showTable(Request $request, $title){
        $user = Auth::user();
        $kolom = ['NISN', 'Nama', 'JK', 'Rombel_Set_Ini'];
        if($request-> has('laporanType')){
            $kolom[] = 'Agama'; 
        }
        $data_siswa = Siswa::select($kolom)->get();
        return view('laporan', compact('results', 'data_siswa', 'sekolah', 'title', 'user'));
    }
}
