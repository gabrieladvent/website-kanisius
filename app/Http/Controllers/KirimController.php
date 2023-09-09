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
use App\Models\SaveSession;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Facades\Notification;

use function PHPUnit\Framework\isEmpty;

class KirimController extends Controller
{
    public function postFile(Request $request, $nomor_s)
    {
        $lastColumn = '';
        $lastColumnIndex = 0;
        $newColumn = '';
        $user = User::all();
        $namasekolah = User::where('id', $nomor_s)->value('namasekolah');

        $userId = Auth::user(); // Mengambil data user yang sedang login
        $userLogin = $userId->id; // Mengambil id dari user yang sedang login
        $users = User::where('status', 'yayasan')->get(); // Mengambil data user yang mempunyai status sebagai yayasan
        $sekolah = User::where('id', $nomor_s)->value('namasekolah');
        // dd($request->file); 
        if($request->file == null){
            return redirect()->back()->with('error', 'Gagal Mengupload File.');
        }
        
        $request->validate([
            'file' => 'required|mimes:xlsx|max:20480',
        ]); // Membuat validasi supaya file yang diupload cuma file excel dengan maksimal 20 mb

        try {
            // Membaca file Excel yang diupload oleh user
            $uploadedFile = $request->file('file');

            if(!$uploadedFile){
                return redirect()->back()->with('error', 'Gagal Mengupload File');
            }
            
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
            $lastSend = 'kirim';

            Notification::send($users, new KirimNotification($filename, $sekolah, $userLogin, $komen, $stt)); // Mengirim data ke KirimNotifikasi
            $data->save(); // Menyimpan data excel  di database

            // Simpan id_kirim yang baru saja di-generate ke dalam session
            Session::put('id_kirim', $data->id_kirim);
            $newSaveSession = SaveSession::create([
                'variabel' => $filename,
                'id_login' => $userLogin,
                'status_kirim' => $lastSend,
            ]);
            // dd($newSaveSession);            
            
            return redirect()->route('sukses')->with([
                'filename' => $filename,
                'komentar' => $komentar,
                'id_kirim' => $data->id_kirim,
            ])->with('success', 'File berhasil diunggah.');
        } catch (\Exception $e) {
            // Jika gagal maka laman tidak akan berubah

            return redirect()->back()->with('error', 'Gagal Mengirimkan File');

        }
    }

    public function deleteFile($filename)
    {
        try {
            if (Storage::exists('public/simpanFile/' . $filename)) {
                $fileToDelete = DB::table('kirim')
                    ->where('nama_file', $filename)
                    ->where('ID', Auth::user()->id)
                    ->first();

                if ($fileToDelete) {
                    $newSaveSession = SaveSession::create([
                        'variabel' => $filename,
                        'id_login' => Auth::user()->id,
                        'status_kirim' => 'hapus',
                    ]);

                    $deletedSessions = SaveSession::where('id_login', Auth::user()->id)
                        ->where('status_kirim', 'kirim')
                        ->delete();
                    
                    $notif = DB::table('notifications')
                        ->where('data', 'LIKE', '%"name":"' . $filename . '"%')
                        ->latest()
                        ->first();

                    // dd($notif);
                    if ($notif) {
                        DB::table('notifications')
                            ->where('id', $notif->id)
                            ->delete();
                    }

                    DB::table('kirim')
                        ->where('nama_file', $filename)
                        ->where('ID', Auth::user()->id)
                        ->delete();
                    Storage::delete('public/simpanFile/' . $filename);
                    return redirect()->route('upload-view', ['slug' => Auth::user()->slug])->with('success', 'File berhasil dihapus.');
                } else {
                    abort(404, 'Kesalahan Menghapus');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function kirim_file()
    {
        $user = Auth::user();
        $title = 'Upload File';

        // Mengambil nilai waktu portal untuk mengecek apakah sedang ada portal atau tidak
        $upload_start = Portal::all()->value('upload_start');
        $upload_end = Portal::all()->value('upload_end');

        if (\Carbon\Carbon::now()->between(\Carbon\Carbon::parse($upload_start), \Carbon\Carbon::parse($upload_end)) === false) {
            DB::table('save_sessions')->delete(); 
        }

        $session = SaveSession::where('id_login', $user->id)
            ->where('status_kirim', 'kirim')
            ->latest()
            ->first();

        // dd($session);
        if (($session && $session->created_at->between(\Carbon\Carbon::parse($upload_start), \Carbon\Carbon::parse($upload_end)) && $session->id_login == $user->id)) {
            return redirect()->route('sukses');
        } else {
            return view('uploadfile', compact('user', 'upload_start', 'upload_end', 'title'));
        }
    }
}
