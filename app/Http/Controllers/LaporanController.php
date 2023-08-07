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
        $siswa = Siswa::all();
        $data_siswa = $siswa->load('sekolah');
        $data_siswa1 = $data_siswa::query(); // Change User::query() to Siswa::query()

        //filter by tingkatan
        $data_siswa1->when($request->tingkatan, function ($query) use ($request) {
            return $query->where('tingkatan', 'like', '%' . $request->tingkatan . '%');
        });

        //filter by namasekolah
        $data_siswa1->when($request->namasekolah, function ($query) use ($request) {
            return $query->where('namasekolah', 'like', '%' . $request->namasekolah . '%');
        });

        //filter by kelasTK
        $data_siswa1->when($request->kelasTK, function ($query) use ($request) {
            return $query->where('kelasTK', 'like', '%' . $request->kelasTK . '%');
        });
        //filter by kelasSD
        $data_siswa1->when($request->kelasSD, function ($query) use ($request) {
            return $query->where('kelasSD', 'like', '%' . $request->kelasSD . '%');
        });
        //filter by kelasSMP
        $data_siswa1->when($request->kelasSMP, function ($query) use ($request) {
            return $query->where('kelasSMP', 'like', '%' . $request->kelasSMP . '%');
        });
        return view('laporan', compact('data_siswa1', 'sekolah', 'title', 'user'));
        // return view('laporan', ['data_siswa' => $data_siswa1->paginate(10)]);
    }

    public function cetakLaporan(Request $request, $title){
        return $request->all();
    }
}
