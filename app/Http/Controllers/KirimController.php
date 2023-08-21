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
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Countdown;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Facades\Notification;


class KirimController extends Controller
{

        // public function kirim_file(Request $request)
        // {
        //     $user = Auth::user();
        //     $title = 'Upload File';
        //     return view('uploadfile', compact('user', 'title'));
        
        // }    

    public function postFile(Request $request, $nomor_s)
    {
        $user = User::all();
        $namasekolah = User::where('id', $nomor_s)->value('namasekolah');

        $userId = Auth::user(); // Mengambil data user yang sedang login
        $userLogin = $userId->id; // Mengambil id dari user yang sedang login
        $users = User::where('status', 'yayasan')->get(); // Mengambil data user yang mempunyai status sebagai yayasan
        $sekolah = User::where('id', $nomor_s)->value('namasekolah');

        $request->validate([
            'file' => 'required|mimes:xlsx|max:20480',
        ]); // Membuat validasi supaya file yang diupload cuma file excel dengan maksimal 20 mb

        try {
            // Membaca file Excel yang diupload oleh user
            $uploadedFile = $request->file('file');
            $filename = $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->getPathname();

            $spreadsheet = IOFactory::load($filePath); // Membuat instance Spreadsheet
            $sheet = $spreadsheet->getActiveSheet(); // Mendapatkan sheet pertama dari file Excel
            $lastColumn = $sheet->getHighestColumn(); // Mencari kolom terakhir yang terisi pada baris pertama (header)
            $lastColumnIndex = Coordinate::columnIndexFromString($lastColumn); // Mengubah huruf kolom terakhir menjadi nomor indeks kolom

            /* 
                Jika diketahui yang login dari SD atau SMP maka maka kolom terakhir yang didapat akan ditambah 1
            */
            $newColumnIndex = 0;
            if (strpos($sekolah, 'TK') === 0) {
                $newColumnIndex = $lastColumnIndex;
            } elseif (strpos($sekolah, 'SD') === 0 || strpos($sekolah, 'SMP') === 0) {
                $newColumnIndex = $lastColumnIndex + 1;
            }

            $newColumn = Coordinate::stringFromColumnIndex($newColumnIndex); // Mengubah kolom terbaru (dafaultnya angka) menjadi string
            $sheet->setCellValue($newColumn . '5', 'nomor_s'); // Menyimpan data nomor_s di kolom terakhir yang terisi pada baris pertama (header)

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

            // Menyimpan data excel tadi ke dalam database
            $data = new Kirim();
            $data->nama_file = $filename;
            $data->ID = $nomor_s;
            $komentar = $request->input('komentar');
            $data->Komentar = !empty($komentar) ? $komentar : '';
            $status = 1; // 1 = Belum dibaca | 2 = Sudah dibaca
            $data->status = $status;

            // Menyimpan komentar dan status yang disimpan ke dalam variabel supaya nantinya bisa dilempar ke kirimNotifikasi untuk dibuat databasenya
            $komen = !empty($komentar) ? $komentar : '';
            $stt  = $status;

            Notification::send($users, new KirimNotification($filename, $sekolah, $userLogin, $komen, $stt)); // Mengirim data ke KirimNotifikasi
            $data->save(); // Menyimpan data excel  di database

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

            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah file.');

        }
    }

    public function deleteFile($filename)
    {

        // dd(Storage::exists('public/simpanFile/'.$filename));
        // Hapus file dengan nama yang diberikan
        // return redirect()->back()->with('gagal', 'Terjadi kesalahan saat mengunggah file.')->withInput();
        if (Storage::exists('public/simpanFile/'.$filename)) {
            Storage::delete('public/simpanFile/'.$filename);
    
            DB::delete("DELETE FROM kirim WHERE nama_file = ? AND ID = ?", [$filename, Auth::user()->id]);
            return redirect()->route('upload-view',['slug' => 'slug'])->with('success', 'File berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');

        $data = Auth::Kirim();
        // $title = 'Upload File';
        return view('uploadfile', compact('data', 'title'));
     }
    }

    public function kirim_file()
    {
        $user = Auth::user();
        $title = 'Upload File';

        // Mengambil nilai waktu portal untuk mengecek apakah sedang ada portal atau tidak
        $upload_start = Portal::all()->value('upload_start');
        $upload_end = Portal::all()->value('upload_end');

        return view('uploadfile', compact('user', 'upload_start', 'upload_end', 'title'));
    }

        public function getendtime(){
            $countdown = Countdown::Portal('upload_end')->find(1); // Ganti dengan query yang sesuai
            return view('countdown', ['countdownDatetime' => $countdown->upload_end]);
        }
    }
    