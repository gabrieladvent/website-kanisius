<?php

namespace App\Http\Controllers;

use App\Models\Kirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

            // dd($data);
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

    public function showdelete()
    {
        $data = Auth::Kirim();
        // $title = 'Upload File';
        return view('uploadfile', compact('data', 'title'));
    }

    public function deleteFile($id)
    {
        // Cari data berdasarkan ID
        $data = Kirim::find($id);

        // Jika data tidak ditemukan, kembalikan respons atau lakukan sesuai kebutuhan Anda
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Hapus data
        $data->delete();

        // Berikan respons yang sesuai
        return response()->json(['message' => 'Data deleted successfully'], 200);
    }

    public function updateFile()
    {
    }
}
