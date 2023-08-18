<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Kirim;
use App\Models\Siswa;
use App\Models\Arship;
use App\Models\Arsip_TK;
use App\Models\Siswa_TK;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;

class SiswaTKController extends Controller
{
    public function updateDataTK($id)
    {
        // Mulai transaksi database untuk memastikan konsistensi data
        DB::beginTransaction();
        try {
            // Ambil data dari tabel Kirim berdasarkan id
            $kirim = Kirim::where('id_kirim', $id)->first();

            if (!$kirim) {
                throw new \Exception('Data tidak ditemukan');
            }

            $filename = $kirim->nama_file;
            $user = Kirim::where('id_kirim', $id)->value('ID');
            $name = User::where('id', $user)->value('namasekolah');
            $notifications = DB::table('notifications')
                ->select('id')
                ->where('data', 'LIKE', '%"name":"' . $filename . '"%')
                ->orWhere('data', 'LIKE', '%"namasekolah":" ' . $name . ' "%')
                ->pluck('id');
            // dd($notifications);
            if (!$notifications) {
                dd('Data kosong');
            }
            // dd('keluar if');
            DB::table('notifications')
                ->whereIn('id', $notifications)
                ->delete();

            // Ambil path file Excel
            $file = public_path('storage/simpanFile/' . $kirim->nama_file);

            // Baca data dari file Excel
            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $dataExcel = $worksheet->toArray();

            // Hapus header (baris 1 hingga 6)
            for ($i = 0; $i < 6; $i++) {
                array_shift($dataExcel);
            }

            // Pesan sebelum pemindahan data
            echo "Memulai pemindahan data...\n";

            // Cek data di tabel siswa, apakah ada di tabel siswa yang sama.
            foreach ($dataExcel as $rowData) {
                // Cek apakah data memiliki NOMOR_S
                // dd($rowData[22]);
                if (isset($rowData[22]) && !empty($rowData[22])) {
                    // dd('masuk if');
                    // Cari data siswa dengan NOMOR_S yang sama di tabel Siswa
                    $siswa = Siswa_TK::where('NOMOR_S', $rowData[22])->get();
                    // dd($siswa);
                    if ($siswa->isNotEmpty()) {
                        // Memindahkan data siswa ke tabel Arship dan hapus dari tabel Siswa
                        foreach ($siswa as $siswaItem) {
                            // dd($siswaItem);
                            Arsip_TK::create($siswaItem->toArray());
                            $siswaItem->delete();
                        }
                    }
                }
            }

            // Memasukkan data dari file Excel ke tabel Siswa
            foreach ($dataExcel as $rowData) {
                // Ubah format
                $tanggal_lahir = $rowData[9];                
                $tanggal_masuk = $rowData[19];
                $tanggal_lahir_formatted = date('Y-m-d', strtotime($tanggal_lahir));
                $tanggal_masuk_formatted = date('Y-m-d', strtotime($tanggal_masuk));


                // dd('masuk perulangan kedua');
                Siswa_TK::create([
                    'no_siswa' => $rowData[0],
                    'nama_siswa' => $rowData[1],
                    'NIK' => $rowData[2],
                    'NIS' => $rowData[3],
                    'NISN' => $rowData[4],
                    'gender' => $rowData[5],
                    'agama' => $rowData[6],
                    'alamat' => $rowData[7],
                    'kota' => $rowData[8],
                    'tanggal_lahir' => $tanggal_lahir_formatted,
                    'kota_lahir' => $rowData[10],
                    'nama_orang_tua' => $rowData[11],
                    'telepon' => $rowData[12],
                    'no_virtual' => $rowData[13],
                    'no_bank' => $rowData[14],
                    'keterangan' => $rowData[15],
                    'keterangan_satu' => $rowData[16],
                    'keterangan_dua' => $rowData[17],
                    'no_cabang' => $rowData[18],
                    'tanggal_masuk' => $tanggal_masuk_formatted,
                    'status' => $rowData[20],
                    'email_orang_tua' => $rowData[21],
                    'NOMOR_S' => $rowData[22],
                ]);
            }
            $data['status'] = 2;
            Kirim::where('id_kirim', $id)->update($data);
            // Commit transaksi database
            DB::commit();
            // dd('bisa commit');

            // Pesan setelah commit
            echo "Transaksi berhasil di-commit.\n";

            return redirect()->route('dashboard.data')->with('success', 'Data Siswa Berhasil Di Update');
        } catch (\Exception $e) {
            // Rollback transaksi database jika terjadi error
            DB::rollback();
            // Tampilkan pesan error
            dd($e->getMessage());
            return redirect()->back()->with('gagal', 'Gagal Mengupdate Data');
        }
    }

    public function downloadAndUpdateTK($id)
    {
        $kirim = Kirim::where('id_kirim', $id)->first();
        if (!$kirim) {
            abort(404, 'Data Tidak Ditemukan');
        }

        $filename = $kirim->nama_file;
        $user = Kirim::where('id_kirim', $id)->value('ID');
        $name = User::where('id', $user)->value('namasekolah');
        $notifications = DB::table('notifications')
            ->select('id')
            ->where('data', 'LIKE', '%"name":"' . $filename . '"%')
            ->orWhere('data', 'LIKE', '%"namasekolah":" ' . $name . ' "%')
            ->pluck('id');

        if (!$notifications) {
            abort(404, 'Data Tidak Ditemukan');
        }

        DB::table('notifications')
            ->whereIn('id', $notifications)
            ->delete();

        $filepath = public_path('storage/simpanFile/' . $kirim->nama_file);
        if (!file_exists($filepath)) {
            abort(404, 'Data Tidak Ditemukan');
        }

        $spreadsheet = IOFactory::load($filepath);
        $worksheet = $spreadsheet->getActiveSheet();
        $dataExcel = $worksheet->toArray();

        DB::beginTransaction();
        try {
            // Hapus header (baris 1 hingga 6)
            for ($i = 0; $i < 6; $i++) {
                array_shift($dataExcel);
            }

            // Pesan sebelum pemindahan data
            echo "Memulai pemindahan data...\n";

            // Cek data di tabel siswa, apakah ada di tabel siswa yang sama.
            foreach ($dataExcel as $rowData) {
                // Cek apakah data memiliki NOMOR_S
                // dd($rowData[22]);
                if (isset($rowData[22]) && !empty($rowData[22])) {
                    // dd('masuk if');
                    // Cari data siswa dengan NOMOR_S yang sama di tabel Siswa
                    $siswa = Siswa_TK::where('NOMOR_S', $rowData[22])->get();
                    // dd($siswa);
                    if ($siswa->isNotEmpty()) {
                        // Memindahkan data siswa ke tabel Arship dan hapus dari tabel Siswa
                        foreach ($siswa as $siswaItem) {
                            // dd($siswaItem);
                            Arsip_TK::create($siswaItem->toArray());
                            $siswaItem->delete();
                        }
                    }
                }
            }

            // Memasukkan data dari file Excel ke tabel Siswa
            foreach ($dataExcel as $rowData) {
                // Ubah format
                $tanggal_lahir = $rowData[9];                
                $tanggal_masuk = $rowData[19];
                $tanggal_lahir_formatted = date('Y-m-d', strtotime($tanggal_lahir));
                $tanggal_masuk_formatted = date('Y-m-d', strtotime($tanggal_masuk));


                // dd('masuk perulangan kedua');
                Siswa_TK::create([
                    'no_siswa' => $rowData[0],
                    'nama_siswa' => $rowData[1],
                    'NIK' => $rowData[2],
                    'NIS' => $rowData[3],
                    'NISN' => $rowData[4],
                    'gender' => $rowData[5],
                    'agama' => $rowData[6],
                    'alamat' => $rowData[7],
                    'kota' => $rowData[8],
                    'tanggal_lahir' => $tanggal_lahir_formatted,
                    'kota_lahir' => $rowData[10],
                    'nama_orang_tua' => $rowData[11],
                    'telepon' => $rowData[12],
                    'no_virtual' => $rowData[13],
                    'no_bank' => $rowData[14],
                    'keterangan' => $rowData[15],
                    'keterangan_satu' => $rowData[16],
                    'keterangan_dua' => $rowData[17],
                    'no_cabang' => $rowData[18],
                    'tanggal_masuk' => $tanggal_masuk_formatted,
                    'status' => $rowData[20],
                    'email_orang_tua' => $rowData[21],
                    'NOMOR_S' => $rowData[22],
                ]);
            }
            $data['status'] = 2;
            Kirim::where('id_kirim', $id)->update($data);
            // Commit transaksi database
            DB::commit();
            // dd('bisa commit');

            // Pesan setelah commit
            echo "Transaksi berhasil di-commit.\n";
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        try {
            // Hapus kolom NOMOR_S (kolom terakhir) dari setiap baris
            foreach ($worksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                foreach ($cellIterator as $cell) {
                    if ($cell->getColumn() == 'W') {
                        // Hapus kolom NOMOR_S dari setiap baris
                        $colIndex = Coordinate::columnIndexFromString($cell->getColumn());
                        $worksheet->removeColumnByIndex($colIndex);
                    }
                }
            }

            // Simpan perubahan ke file sementara
            $tempFileName = 'File ' . $kirim->nama_file;
            $tempFilePath = storage_path('app/public/simpanFile/temp_/' . $tempFileName);
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($tempFilePath);

            Session::flash('success', 'Data berhasil disimpan.');
            
            // Continue to download the file
            return response()->download($tempFilePath, $tempFileName, [
                'Content-Disposition' => 'attachment; filename="' . $kirim->nama_file . '"',
                'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
                'Pragma' => 'no-cache',
            ])->deleteFileAfterSend();
        } catch (\Exception $e) {
            abort(404, 'Data Invalid');
        }
    }
}
