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

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class KirimController extends Controller
{
    public function kirim_file()
    {
        $user = Auth::user();
        $title = 'Upload File';
        return view('uploadfile', compact('user', 'title'));
    }

    //Fungsi untuk memproses file yang diupload
    public function showdelete()
    {
        $data = Auth::Kirim();
        // $title = 'Upload File';
        return view('uploadfile', compact('data', 'title'));
    }
    
    public function postFile(Request $request, $nomor_s)
    {
        // Membuat validasi supaya file yang diupload cuma file excel dengan maksimal 20 mb
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:20480',
        ]);

        try {
            // Membaca file Excel yang diupload oleh user
            $uploadedFile = $request->file('file');
            $filename = $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->getPathname();

            // Membuat instance Spreadsheet
            $spreadsheet = IOFactory::load($filePath);
            // Mendapatkan sheet pertama dari file Excel
            $sheet = $spreadsheet->getActiveSheet();
            // Mencari kolom terakhir yang terisi pada baris pertama (header)
            $lastColumn = $sheet->getHighestColumn();
            // Mengubah huruf kolom terakhir menjadi nomor indeks kolom
            $lastColumnIndex = Coordinate::columnIndexFromString($lastColumn);

            // Menyimpan data nomor_s di kolom terakhir yang terisi pada baris pertama (header)
            $newColumnIndex = $lastColumnIndex + 1;
            $newColumn = Coordinate::stringFromColumnIndex($newColumnIndex);
            $sheet->setCellValue($newColumn . '5', 'nomor_s');

            // Menyimpan data nomor_s pada kolom terakhir yang terisi dari baris kedua hingga sesuai dengan banyaknya data pada kolom A
            $lastRow = $sheet->getHighestRow();
            $startRow = 6;
            for ($i = $startRow; $i <= $lastRow; $i++) {
                $sheet->setCellValue($newColumn . $i, $nomor_s);
            }

            // Menyimpan file Excel yang sudah dimodifikasi
            $writer = new Xlsx($spreadsheet);
            $writer->save($filePath);

            // Simpan file ke server dengan mengambil nama dari yang sebelumnya, dan meminta original ekstensionnya
            $uploadedFile->storeAs('public/simpanFile', $filename);

            // ... Lanjutkan dengan kode Anda untuk menyimpan data ke database ...
            $data = new Kirim();
            $data->nama_file = $filename;
            $data->ID = $nomor_s;
            $komentar = $request->input('komentar');
            $data->Komentar = !empty($komentar) ? $komentar : '';
            $data->save();

            // Simpan id_kirim yang baru saja di-generate ke dalam session
            Session::put('id_kirim', $data->id_kirim);

            return redirect()->route('sukses')->with([
                'filename' => $filename,
                'komentar' => $komentar,
                'id_kirim' => $data->id_kirim,
            ])->with('success', 'File berhasil diunggah.');
        } catch (\Exception $e) {
            // Jika gagal maka laman tidak akan berubah
            return redirect()->route('sukses')->with([
                'filename' => $filename,
                'komentar' => $komentar,
                'id_kirim' => $data->id_kirim,
            ])->with('success', 'File berhasil diunggah.');
        }
    }

    public function deleteFile($filename)
    {
        // dd(Storage::exists('public/simpanFile/'.$filename));
       // Hapus file dengan nama yang diberikan
        if (Storage::exists('public/simpanFile/'.$filename)) {
            Storage::delete('public/simpanFile/'.$filename);

            DB::delete("DELETE FROM kirim WHERE nama_file = ? AND ID = ?", [$filename, Auth::user()->id]);
            return redirect()->back()->with('success', 'File berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }
}
