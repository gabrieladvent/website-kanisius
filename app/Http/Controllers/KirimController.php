<?php

namespace App\Http\Controllers;

use App\Models\Kirim;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KirimController extends Controller
{
    // Fungsi untuk memproses file yang diupload
    public function postFile(Request $request)
    {
        $id = 2039; //Cuma nilai sementara, nantinya akan diubah

        // Membuat validasi supaya file yang diupload cuma file excel dengan maksimal 20 mb
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:20480',
        ]);

        try {
            $data = new Kirim();
            // Mengambil nama file yang diupload dengan nama aslinya
            $data->nama_file = $request->file('file')->getClientOriginalName();
            $data->ID = $id;
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
            return redirect()->route('success')->with('filename', $name)->with('Sukses', 'File berhasil diunggah.');
        } catch (\Exception $e) {
            // Jika gagal maka laman tidak akan berubah
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah file.')->withInput();
        }
    }

    public function removeFile()
    {
        $id = 2039; 
        // $data = Kirim::where('ID', $id)->latest('created_at')->first();
        // if ($data) {
        //     Storage::delete('public/simpanFile', basename($data->nama_file)) ;
        //     $data->delete();
        //     return redirect()->route('sekolah', ['nomor_s' => 2032])->with('Sukses', 'File berhasil dihapus.');
        // } else {
        //     return redirect()->route('/sekolah/2032/upload')->with('error', 'File tidak ditemukan.');
        // }

        // $id = $request->input('id');
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


// public function delete($basename)
// {
//     $file = $this->search($basename);
//     $type = $file->resource['mimeType'];
//     try {
//         switch ($type) {
//             case 'image/jpg': // masih belum bisa, kemungkinan karena browser atau cors policy
//             case 'image/jpeg':
//             case 'image/png':
//                 Storage::delete(self::$BASE_DIR_IMAGE . $basename);
//                 break;
//             case 'application/pdf':
//                 Storage::delete(self::$BASE_DIR_DOCUMENT . $basename);
//                 break;
//             default:
//                 break;
//         }
//         return new JsonResponse(200, 'Hapus File Berhasil', true);
//     } catch (\Throwable $th) {
//         return new JsonResponse(200, '', false);
//     }
// }