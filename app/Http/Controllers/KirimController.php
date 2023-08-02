<?php

namespace App\Http\Controllers;

use App\Models\Kirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;

class KirimController extends Controller
{
    public function kirim_file()
    {
        $user = Auth::user();
        $title = 'Upload File';
        return view('uploadfile', compact('user', 'title'));
    }
    //Fungsi untuk memproses file yang diupload
    public function postFile(Request $request, $nomor_s)
{
    // Membuat validasi supaya file yang diupload cuma file excel dengan maksimal 20 mb
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv|max:20480',
    ]);

    try {
        $data = new Kirim();
        $data->nama_file = $request->file('file')->getClientOriginalName();
        $data->ID = $nomor_s;
        $komentar = $request->input('komentar');
        $data->Komentar = !empty($komentar) ? $komentar : '';

        // Simpan komentar ke dalam session supaya bisa diakses dari laman upload sukses
        Session::put('komentar', $data->Komentar);

        // Simpan sebuah session untuk bisa akses ke upload sukses
        Session::put('upload_sukses', true);

        // Simpan data ke database
        $data->save();

        // Simpan file ke server dengan mengambil nama dari yang sebelumnya, dan meminta original ekstensionnya
        $filename = $data->nama_file . '.' . $request->file('file')->getClientOriginalExtension();
        $uploadedFile = $request->file('file');
        // Memindahkan file ke server
        $filePath = $uploadedFile->storeAs('public/simpanFile', $filename);

        $name = $data->nama_file;
        $id_kirim = $data->id_kirim;
        // Simpan id_kirim ke dalam session
        Session::put('id_kirim', $data->id_kirim);

        // Redirect ke route "sukses" dengan menyertakan ID sebagai parameter di URL
        return redirect()->route('sukses', ['id_kirim' =>$id_kirim])->with([
            'filename' => $name,
            'komentar' => $komentar,
            'id_kirim' => $id_kirim,
        ]);
    } catch (\Exception $e) {
        // Jika gagal maka laman tidak akan berubah
        return redirect()->back()->with('error')->withInput();
    }
}

    

    // public function postFile(Request $request)
    // {
    //     // Validasi file yang diupload
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls,csv|max:20480',
    //     ]);

    //     // Simpan file ke dalam server dan database
    //     $filename = $request->file('file')->getClientOriginalName();
    //     $uploadedFile = $request->file('file');
    //     $filePath = $uploadedFile->storeAs('public/simpanFile', $filename);

    //     $data = new Kirim();
    //     $data->nama_file = $filename;
    //     $data->save();

    //     return redirect()->route('sukses')->with('success', 'File berhasil diupload dengan ID ');
    // }

   

    public function deleteFile()
    {
       // Cari data berdasarkan ID
       $data = Kirim::all();
       dd($data);

       // Pastikan data ditemukan
       if (!$data) {
           return dd($data);

       try {
           // Hapus file dari penyimpanan (storage)
           Storage::delete('public/simpanFile/' . $data->nama_file);

           // Hapus data dari database
           $data->delete();

           // Hapus session id_kirim jika ada
           Session::forget('id_kirim');

           return dd('berhasil');
       } catch (\Exception $e) {
           return dd('gagal');
       }
    }
}


}
    