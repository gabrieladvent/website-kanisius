<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use App\Models\Siswa;
use App\Models\Arship;
use App\Models\Siswa_TK;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;

class SiswaController extends Controller
{
    /*
        Method untuk menampilkan seluruh data siswa yang ingin dilihat oleh yayasan
    */
    public function index($title)
    {
        $user = Auth::user();
        $siswa = Siswa::all(); // Mengambil data siswa (SD dan SMP)
        $tk = Siswa_TK::all(); // Mengambil data siswa (TK)

        // Lakukan eager loading untuk data sekolah terkait
        $data_siswa = $siswa->load('sekolah');
        $data_tk = $tk->load('sekolah');

        return view('tabeluseryayasan', compact('data_siswa', 'data_tk', 'title', 'user'));
    }

    /*
        Method untuk menampilkan data siswa untuk sekolah berdasarkan sekolah yang login
    */
    public function detailSiswa($slug, $title)
    {
        $id = User::where('slug', $slug)->value('id'); // Dapatkan id siswa berdasarkan slug dari tabel User
        $data = Siswa::where('nomor_s', $id)->get(); // Dapatkan siswa-siswa dari tabel siswa yang memiliki nomor_s yang sama dengan id

        $user = Auth::user();
        $isTK = $user->namasekolah;
        $TK = Siswa_TK::where('NOMOR_S', $id)->get();

        if ($data) {
            return view('dataSiswaSekolah', compact('data', 'isTK', 'TK', 'user', 'title'));
        } else {
            abort(404, 'Siswa Tidak Ditemukan');
        }
    }

    /* 
        Method untuk update data siswa 
    */
    public function updateData($id)
    {
        DB::beginTransaction(); // Mulai transaksi database untuk memastikan konsistensi data
        try {
            $kirim = Kirim::where('id_kirim', $id)->first(); // Ambil data dari tabel Kirim berdasarkan id

            // Mengecek file di database
            if (!$kirim) {
                return redirect()->back()->with('error', 'Data Tidak temukan');
            }

            $filename = $kirim->nama_file; // Mengambil nama file excel
            $user = Kirim::where('id_kirim', $id)->value('ID');
            $name = User::where('id', $user)->value('namasekolah');
            $notifications = DB::table('notifications')
                ->select('id')
                ->where('data', 'LIKE', '%"name":"' . $filename . '"%')
                ->orWhere('data', 'LIKE', '%"namasekolah":" ' . $name . ' "%')
                ->pluck('id');
            
            if (!$notifications) {
                return redirect()->back()->with('error', 'Data Tidak Ditmukan');
            }
            
            DB::table('notifications')
                ->whereIn('id', $notifications)
                ->delete();

            $file = public_path('storage/simpanFile/' . $kirim->nama_file); // Ambil path file Excel

            // Baca data dari file Excel
            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $dataExcel = $worksheet->toArray();

            // Hapus header (baris 1 hingga 6)
            for ($i = 0; $i < 6; $i++) {
                array_shift($dataExcel);
            }

            // Hapus kolom A dari setiap baris
            foreach ($dataExcel as &$rowData) {
                unset($rowData[0]); // Hapus kolom A (indeks 0) dari baris saat ini
                $rowData = array_values($rowData); // Reset indeks array setelah menghapus kolom A
            }
            unset($rowData);

            // Cek data di tabel siswa, apakah ada di tabel siswa yang sama.
            foreach ($dataExcel as $rowData) {
                // Cek apakah data memiliki NOMOR_S
                if (isset($rowData[65]) && !empty($rowData[65])) {
                    // Cari data siswa dengan NOMOR_S yang sama di tabel Siswa
                    $siswa = Siswa::where('NOMOR_S', $rowData[65])->get();
                    if ($siswa->isNotEmpty()) {
                        // Memindahkan data siswa ke tabel Arship dan hapus dari tabel Siswa
                        foreach ($siswa as $siswaItem) {
                            Arship::create($siswaItem->toArray());
                            $siswaItem->delete();
                        }
                    }
                }
            }

            // Memasukkan data dari file Excel ke tabel Siswa
            foreach ($dataExcel as $rowData) {
                Siswa::create([
                    'Nama' => $rowData[0],
                    'NIPD' => $rowData[1],
                    'JK' => $rowData[2],
                    'NISN' => $rowData[3],
                    'Tempat_lahir' => $rowData[4],
                    'Tanggal_Lahir' => $rowData[5],
                    'NIK' => $rowData[6] !== '' ? $rowData[6] : null,
                    'Agama' => $rowData[7],
                    'Alamat' => $rowData[8],
                    'RT' => $rowData[9],
                    'RW' => $rowData[10],
                    'Dusun' => $rowData[11],
                    'Kelurahan' => $rowData[12],
                    'Kecamatan' => $rowData[13],
                    'kode_pos' => $rowData[14],
                    'Jenis_Tinggal' => $rowData[15],
                    'Alat_Transportasi' => $rowData[16],
                    'Telepon' => $rowData[17],
                    'HP' => $rowData[18],
                    'Email' => $rowData[19],
                    'SKHUN' => $rowData[20],
                    'Penerima_KPS' => $rowData[21],
                    'No_KPS' => $rowData[22] !== '' ? $rowData[22] : null,
                    'Nama_Ayah' => $rowData[23],
                    'Tahun_Lahir_Ayah' => $rowData[24],
                    'Jenjang_Pendidikan_Ayah' => $rowData[25],
                    'Pekerjaan_Ayah' => $rowData[26],
                    'Penghasilan_Ayah' => $rowData[27],
                    'NIK_Ayah' => $rowData[28],
                    'Nama_ibu' => $rowData[29],
                    'Tahun_Lahir_Ibu' => $rowData[30],
                    'Jenjang_Pendidikan_Ibu' => $rowData[31],
                    'Pekerjaan_Ibu' => $rowData[32],
                    'Penghasilan_Ibu' => $rowData[33],
                    'NIK_Ibu' => $rowData[34],
                    'Nama_wali' => $rowData[35],
                    'Tahun_Lahir_wali' => $rowData[36],
                    'Jenjang_Pendidikan_wali' => $rowData[37],
                    'Pekerjaan_wali' => $rowData[38],
                    'Penghasilan_wali' => $rowData[39],
                    'NIK_wali' => $rowData[40],
                    'Rombel_Set_Ini' => $rowData[41],
                    'No_Peserta_Ujian_Nasional' => $rowData[42],
                    'No_Seri_Ijazah' => $rowData[43],
                    'Penerima_KIP' => $rowData[44],
                    'Nomor_KIP' => $rowData[45],
                    'Nama_di_KIP' => $rowData[46],
                    'No_KKS' => $rowData[47],
                    'No_Registrasi_Akta_Lahir' => $rowData[48],
                    'Bank' => $rowData[49],
                    'Nomor_Rekening_Bank' => $rowData[50],
                    'Rekening_atas_nama' => $rowData[51],
                    'Layak_PIP' => $rowData[52],
                    'Alasan_Layak_PIP' => $rowData[53],
                    'Kebutuhan_Khusus' => $rowData[54],
                    'Sekolah_Asal' => $rowData[55],
                    'Anak_ke_berapa' => $rowData[56],
                    'Lintang' => $rowData[57],
                    'bujur' => $rowData[58],
                    'No_KK' => $rowData[59],
                    'Berat_Badan' => $rowData[60],
                    'Tinggi_badan' => $rowData[61],
                    'Lingkar_Kepala' => $rowData[62],
                    'Jml_Saudara_Kandung' => $rowData[63],
                    'Jarak_Rumah_ke_Sekolah' => $rowData[64],
                    'NOMOR_S' => $rowData[65],
                ]);
            }
            // Mengubah status menjadi sudah dibaca
            $data['status'] = 2;
            $affectedRows = Kirim::where('id_kirim', $id)->update($data);
            $kirim = Kirim::where('id_kirim', $id)->first();

            // Commit transaksi database
            DB::commit();
            
            return redirect()->route('dashboard.data')->with('success', 'Data Siswa Berhasil Di Update');
            
        } catch (\Exception $e) {
            // Rollback transaksi database jika terjadi error
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal Mengupdate Data');
        }
    }

    public function download($id)
    {
        try {
            $kirim = Kirim::where('id_kirim', $id)->first();
            if (!$kirim) {
                throw new \Exception('Data tidak ditemukan');
            }
            // Mendapatkan path file Excel
            $filePath = storage_path('app/public/simpanFile/' . $kirim->nama_file);
            if (!file_exists($filePath)) {
                abort(404, 'File not found');
            }
            // Baca data dari file Excel
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();

            // Hapus kolom NOMOR_S (kolom terakhir) dari setiap baris
            foreach ($worksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                foreach ($cellIterator as $cell) {
                    if ($cell->getColumn() == 'BO') { // Assuming NOMOR_S is in column N
                        // Hapus kolom NOMOR_S dari setiap baris
                        $colIndex = Coordinate::columnIndexFromString($cell->getColumn());
                        $worksheet->removeColumnByIndex($colIndex);
                    }
                }
            }

            // Simpan perubahan ke file sementara
            $tempFileName = 'temp_' . $kirim->nama_file;
            // dd($tempFileName);
            $tempFilePath = storage_path('app/public/simpanFile/temp_/' . $tempFileName);
            // dd($tempFilePath);
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($tempFilePath);
            // dd($writer);

            // Mendownload file Excel yang telah dimodifikasi tanpa kolom NOMOR_S
            if (file_exists($tempFilePath)) {
                // dd('masuk if');
                return response()->download($tempFilePath, $tempFileName, [
                    'Content-Disposition' => 'attachment; filename="' . $kirim->nama_file . '"',
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
                    'Pragma' => 'no-cache',
                ])->deleteFileAfterSend(); // Menandai file untuk dihapus setelah didownload
            } else {
                abort(404, 'Temporary file not found');
            }
            dd('keluar if');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('gagal', 'File Tidak Bisa Didownload');
        }
    }

    /*
        Method untuk mengupdate sekaligus mengdownload file excel
    */
    public function downloadAndUpdate($id)
    {
        $kirim = Kirim::where('id_kirim', $id)->first();
        if (!$kirim) {
            return redirect()->back()->with('error', 'Data Tidak temukan');
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
            return redirect()->back()->with('error', 'Data Tidak temukan');
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

            // Hapus kolom A dari setiap baris
            foreach ($dataExcel as &$rowData) {
                unset($rowData[0]); // Hapus kolom A (indeks 0) dari baris saat ini
                $rowData = array_values($rowData); // Reset indeks array setelah menghapus kolom A
            }
            unset($rowData);

            // Cek data di tabel siswa, apakah ada di tabel siswa yang sama.
            foreach ($dataExcel as $rowData) {
                // Cek apakah data memiliki NOMOR_S
                if (isset($rowData[65]) && !empty($rowData[65])) {
                    // Cari data siswa dengan NOMOR_S yang sama di tabel Siswa
                    $siswa = Siswa::where('NOMOR_S', $rowData[65])->get();
                    if ($siswa->isNotEmpty()) {
                        // Memindahkan data siswa ke tabel Arship dan hapus dari tabel Siswa
                        foreach ($siswa as $siswaItem) {
                            Arship::create($siswaItem->toArray());
                            $siswaItem->delete();
                        }
                    }
                }
            }

            // Memasukkan data dari file Excel ke tabel Siswa
            foreach ($dataExcel as $rowData) {
                Siswa::create([
                    'Nama' => $rowData[0],
                    'NIPD' => $rowData[1],
                    'JK' => $rowData[2],
                    'NISN' => $rowData[3],
                    'Tempat_lahir' => $rowData[4],
                    'Tanggal_Lahir' => $rowData[5],
                    'NIK' => $rowData[6] !== '' ? $rowData[6] : null,
                    'Agama' => $rowData[7],
                    'Alamat' => $rowData[8],
                    'RT' => $rowData[9],
                    'RW' => $rowData[10],
                    'Dusun' => $rowData[11],
                    'Kelurahan' => $rowData[12],
                    'Kecamatan' => $rowData[13],
                    'kode_pos' => $rowData[14],
                    'Jenis_Tinggal' => $rowData[15],
                    'Alat_Transportasi' => $rowData[16],
                    'Telepon' => $rowData[17],
                    'HP' => $rowData[18],
                    'Email' => $rowData[19],
                    'SKHUN' => $rowData[20],
                    'Penerima_KPS' => $rowData[21],
                    'No_KPS' => $rowData[22] !== '' ? $rowData[22] : null,
                    'Nama_Ayah' => $rowData[23],
                    'Tahun_Lahir_Ayah' => $rowData[24],
                    'Jenjang_Pendidikan_Ayah' => $rowData[25],
                    'Pekerjaan_Ayah' => $rowData[26],
                    'Penghasilan_Ayah' => $rowData[27],
                    'NIK_Ayah' => $rowData[28],
                    'Nama_ibu' => $rowData[29],
                    'Tahun_Lahir_Ibu' => $rowData[30],
                    'Jenjang_Pendidikan_Ibu' => $rowData[31],
                    'Pekerjaan_Ibu' => $rowData[32],
                    'Penghasilan_Ibu' => $rowData[33],
                    'NIK_Ibu' => $rowData[34],
                    'Nama_wali' => $rowData[35],
                    'Tahun_Lahir_wali' => $rowData[36],
                    'Jenjang_Pendidikan_wali' => $rowData[37],
                    'Pekerjaan_wali' => $rowData[38],
                    'Penghasilan_wali' => $rowData[39],
                    'NIK_wali' => $rowData[40],
                    'Rombel_Set_Ini' => $rowData[41],
                    'No_Peserta_Ujian_Nasional' => $rowData[42],
                    'No_Seri_Ijazah' => $rowData[43],
                    'Penerima_KIP' => $rowData[44],
                    'Nomor_KIP' => $rowData[45],
                    'Nama_di_KIP' => $rowData[46],
                    'No_KKS' => $rowData[47],
                    'No_Registrasi_Akta_Lahir' => $rowData[48],
                    'Bank' => $rowData[49],
                    'Nomor_Rekening_Bank' => $rowData[50],
                    'Rekening_atas_nama' => $rowData[51],
                    'Layak_PIP' => $rowData[52],
                    'Alasan_Layak_PIP' => $rowData[53],
                    'Kebutuhan_Khusus' => $rowData[54],
                    'Sekolah_Asal' => $rowData[55],
                    'Anak_ke_berapa' => $rowData[56],
                    'Lintang' => $rowData[57],
                    'bujur' => $rowData[58],
                    'No_KK' => $rowData[59],
                    'Berat_Badan' => $rowData[60],
                    'Tinggi_badan' => $rowData[61],
                    'Lingkar_Kepala' => $rowData[62],
                    'Jml_Saudara_Kandung' => $rowData[63],
                    'Jarak_Rumah_ke_Sekolah' => $rowData[64],
                    'NOMOR_S' => $rowData[65],
                ]);
            }

            $data['status'] = 2;
            $affectedRows = Kirim::where('id_kirim', $id)->update($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Mengeksekusi Perintah');
        }

        try {
            // Hapus kolom NOMOR_S (kolom terakhir) dari setiap baris
            foreach ($worksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                foreach ($cellIterator as $cell) {
                    if ($cell->getColumn() == 'BO') {
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

    /*
        Method untuk melihat data siswa secara rinci
    */
    public function SiswaPersonal($nisn, $namasekolah, $title)
    {
        // dd($namasekolah);
        $user = Auth::user();
        if (strpos($namasekolah, 'TK') === 0) {
            $isTK = true;
            $data = Siswa_TK::where('NISN', $nisn)->get();
        } else {
            $isTK = false;
            $data = Siswa::where('NISN', $nisn)->get();
        }
        // dd($data);

        return view('detailSiswa', compact('data', 'user', 'isTK', 'title'));
    }
}
