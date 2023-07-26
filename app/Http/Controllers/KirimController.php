<?php

namespace App\Http\Controllers;

use App\Models\Kirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class KirimController extends Controller
{
    public function kirim_file()
    {
        $user = Auth::user();
        $title = 'Upload File';
        return view('uploadfile', compact('user', 'title'));
    }
    // Fungsi untuk memproses file yang diupload
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

        // Simpan id_kirim ke dalam session
        Session::put('id_kirim', $data->id_kirim);
        // dd($data->id);

        return redirect()->route('sukses')->with([
            'filename' => $name,
            'komentar' => $komentar,
            'id_kirim' => $data->id,
        ])->with('Sukses', 'File berhasil diunggah.');
    } catch (\Exception $e) {
        // Jika gagal maka laman tidak akan berubah
        return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah file.')->withInput();
    }
    }

    public function deleteFile(Request $request)
    {
        $request->validate([
            'id_kirim' => 'required|integer', // Pastikan id_kirim ada dan merupakan integer.
        ]);

        // Ambil nilai id_kirim dari data yang dikirimkan oleh form.
        $idKirim = $request->input('id_kirim');

        // dd($idKirim);

        // Cari data Kirim berdasarkan id_kirim di database.
        $kirim = Kirim::where('id_kirim', $idKirim)->first();
        // dd($kirim->nama_file);

        // Cek apakah data Kirim ditemukan di database.
        if ($kirim) {
            $kirim->delete();

            // Hapus file dari server berdasarkan nama file yang ada di database.
            $filePath = public_path('storage/simpanFile/' . $kirim->nama_file);
            // dd($filePath);

            if (Storage::exists($filePath)) {
                dd('masuk');
            }
            Storage::delete($filePath);
            return redirect()->route('dashboard')->with('success', 'File berhasil dihapus.');
        } else {
            // Jika data Kirim tidak ditemukan, redirect dengan pesan error.
            return redirect()->back()->with('error', 'Data Kirim tidak ditemukan.');
        }
    }

    public function updateFile(){
        
    }
}
