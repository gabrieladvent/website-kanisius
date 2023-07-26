<?php

namespace App\Http\Controllers;

use App\Models\Kirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Cache\Store;
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
            // Mengambil nama file yang diupload dengan nama aslinya
            $data->nama_file = $request->file('file')->getClientOriginalName();
            $data->ID = $nomor_s;
            // Mengambil komentar jika 
            $komentar = $request->input('komentar');
            // Normalisasi: jika komentar kosong maka akan diisi dengan string kosong
            $data->Komentar = !empty($komentar) ? $komentar : '';

            // Simpan komentar ke dalam session supaya bisa diakses dari laman upload sukses
            if (!empty($komentar)) {
                session()->put('komentar', $komentar);
            } else {
                session()->put('komentar', '');
            }
            // Simpan sebuah session untuk bisa akses ke uppload sukses
            session()->put('upload_sukses', true);
            // Simpan data ke database
            $data->save();

            // Simpan file ke server dengan mengambil nama dari yang sebelumnya, dan meminta original ekstensionnya
            $filename = $data->nama_file . '.' . $request->file('file')->getClientOriginalExtension();
            $uploadedFile = $request->file('file');
            // Memindahkan file ke server
            $filePath = $uploadedFile->storeAs('public/simpanFile', $filename);

            $name = $data->nama_file;
            // Jika berhasil maka akan beralih ke laman upload sukses dengan membawa nama file dan parameter untuk swal
            return redirect()->route('sukses')->with('filename', $name)->with('Sukses', 'File berhasil diunggah.');
        } catch (\Exception $e) {
            // Jika gagal maka laman tidak akan berubah
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah file.')->withInput();
        }
    }

    public function removeFile()
    {
        $id = 2039;
        $post = Kirim::where('ID', $id)->latest('created_at')->findOrFail($id);
        dump($post->nama_file);

        $filePath = 'simpanFile/' . basename($post->nama_file);
        dump($filePath);

        $deleted = Storage::disk('public')->delete($filePath);
        dump($deleted, 'File berhasil dihapus!');

        $hapus = $post->delete();
        // dd($hapus, 'Data berhasil dihapus!');

        return redirect()->route('sekolah', ['nomor_s' => 2032])->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
}
