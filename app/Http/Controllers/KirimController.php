<?php

namespace App\Http\Controllers;

use App\Models\Kirim;
use App\Models\Portal;
use App\Models\User;
use App\Notifications\KirimNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use Illuminate\Notifications\Notification;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Facades\Notification;


class KirimController extends Controller
{
    public function kirim_file()
    {
        $user = Auth::user();
        $title = 'Upload File';
        
        $upload_start = Portal::all()->value('upload_start');
        $upload_end = Portal::all()->value('upload_end');
        return view('uploadfile', compact('user', 'upload_start', 'upload_end', 'title'));
    }

    // Fungsi untuk memproses file yang diupload
    public function postFile(Request $request, $nomor_s)
    {
        $user = User::all();
        $namasekolah = User::where('id', $nomor_s)->value('namasekolah');

        $userId = Auth::user();
        $userLogin = $userId->id;
        $users = User::where('status', 'yayasan')->get();
        $sekolah = User::where('id', $nomor_s)->value('namasekolah');

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
            
            if (strpos($sekolah, 'TK') === 0) {
                $newColumnIndex = $lastColumnIndex;
            } elseif(strpos($sekolah, 'SD') === 0 || strpos($sekolah, 'SMP') === 0) {
                $newColumnIndex = $lastColumnIndex + 1;
            }

            
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
            $status = 1;
            $data->status = $status;

            $komen = !empty($komentar) ? $komentar : '';
            $stt  = $status;


            Notification::send($users, new KirimNotification($filename, $sekolah, $userLogin, $komen, $stt));
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
            return redirect()->back()->with('gagal', 'Terjadi kesalahan saat mengunggah file.')->withInput();
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
