<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KirimController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaTKController;
use App\Http\Controllers\YayasanController;
use App\Http\Controllers\LaporanController;
use App\Models\Sekolah;
use Detection\MobileDetect;
use GuzzleHttp\Middleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => \App\Http\Middleware\DeniedMobile::class
], function () {
    Route::get('/regis', function () {
        return view('auth.regis');
    });
    Route::get('/tema', function () {
        return view('postTemaPertamaTemp');
    });

    Route::post('/kirim-post', [YayasanController::class, 'upload'])->name('kirim-post');

    // Route untuk login
    Route::get('/', [LoginController::class, 'index'])->name('login');

    // Registrasi akun
    Route::post('/store', [UserController::class, 'create'])->name('store');

    // Logouttablesekolah
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Masuk ke dashboard
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard')->defaults('title', 'Dashboard');

    // Untuk masuk ke tampilan detail siswa
    Route::get('/detail-siswa/personal/{nisn}/{namasekolah}', [SiswaController::class, 'SiswaPersonal'])->name('detail-siswa-personal')->defaults('title', 'Detail');

    // untuk masuk laporan yayasan 
    Route::get('dashboard/laporan', [LaporanController::class, 'laporan'])->name('laporan-data')->defaults('title', 'Laporan Siswa');

    // Route::post('dashboard/laporan/{title}', [LaporanController::class, 'laporanAgama','showTable'])->name('laporanFilter');
    // Route::post('dashboard/laporan/{title}', [LaporanController::class, 'laporanJenisKelamin'])->name('laporanFilter');
    // Route::post('dashboard/laporan/{title}', [LaporanController::class, 'laporanZonasi'])->name('laporanFilter');
    // Route::post('dashboard/laporan/{title}', [LaporanController::class, 'laporanFilter'])->name('laporanFilter');
    Route::get('dashboard/laporan/{title}', [LaporanController::class, 'laporanFilter'])->name('laporanFilter');

    // Route::get('dashboard/laporan/{title}', [LaporanController::class, 'cetakLaporan'])->name('cetakLaporan');

    Route::post('dashboard/laporan/hasil-pilih', [LaporanController::class, 'laporan_hasil'])->name('laporan-hasil');



    // Masuk ke tampilan profile
    Route::get('dashboard/profile', [DashboardController::class, 'profile'])->name('profile');

    // fungsi untuk update profile 
    Route::put('/update/{id}', [UserController::class, 'update_sekolah'])->name('update');

    Route::get('buku-panduan', [SekolahController::class, 'panduan'])->name('panduan-buku');
    Route::get('tutorial-youTube', [SekolahController::class, 'youTube'])->name('tutorial');

    Route::group([
        'middleware' => 'role:yayasan'
    ], function () {
        // Yang login adalah admin/yayasan
        // Masuk ke tampil data
        Route::get('dashboard/data/', [SiswaController::class, 'index'])->name('dashboard.data')->defaults('title', 'Data Siswa');

        // Masuk ke tampilan update file
        Route::get('/dashboard/kiriman-data', [YayasanController::class, 'kiriman'])->name('kiriman-data')->defaults('title', 'Update Data');

        // Masuk ke tampilan notifikasi
        Route::get('dashboard/notifikasi', [DashboardController::class, 'showNotifikasi'])->name('notifikasi')->defaults('title', 'Pesan');

        // Masuk ke tampilan akun-akun operator
        Route::get('dashboard/akun-yayasan', [UserController::class, 'akun_yayasan'])->name('akun-yayasan')->defaults('title', 'Akun Operator');

        // Masuk ke tampilan edit profile untuk akun operator sekolah
        Route::get('dashboard/edit/{id}', [UserController::class, 'edit'])->name('dashboard.edit')->defaults('title', 'Edit Akun');

        // fungsi untuk update data
        Route::put('dashboard/update/{id}', [UserController::class, 'update'])->name('update-user');

        // Fungsi untuk hapus akun
        Route::delete('dashboard/delete/{id}', [UserController::class, 'delete'])->name('dashboard.delete');

        // Route tambah akun
        Route::get('/dashboard/tambah-akun', function () {
            return view('auth.register', [
                'title' => 'Tambah Akun'
            ]);
        })->name('tambah-akun');

        // Route untuk ganti tema
        Route::post('/updateaction', [YayasanController::class, 'update'])->name('update.profile');

        // Route untuk tampil data yang sudah dikirim
        Route::get('/show-notifikasi/{id}', [YayasanController::class, 'showNotifikasi'])->name('show-notifikasi')->defaults('title', 'Update Data');

        // Untuk Update data siswa 
        Route::post('dashboard/update-siswa/{id}', [SiswaController::class, 'updateData'])->name('update-data');

        // Untuk Download data
        Route::get('dashboard/download/{id}', [SiswaController::class, 'download'])->name('download-file');

        // Untuk download dan update
        Route::get('/update-and-download/{id}', [SiswaController::class, 'downloadAndUpdate'])->name('update-and-download');

        // data TK
        // Untuk Update data siswa 
        Route::post('dashboard/update-siswa/TK/{id}', [SiswaTKController::class, 'updateDataTK'])->name('update-data-TK');

        // Untuk download dan update
        Route::get('/update-and-download/TK/{id}', [SiswaTKController::class, 'downloadAndUpdateTK'])->name('update-and-download-TK');

        // Untuk masuk ke daftar sekolah
        Route::get('dashboard/daftar-sekolah', [DashboardController::class, 'daftarSekolah'])->name('daftar-sekolah')->defaults('title', 'Daftar Sekolah');

        // set Portal
        Route::get('dashboard/portal-upload', [DashboardController::class, 'portal_view'])->name('portal-view')->defaults('title', 'Portal Upload');

        Route::post('/post', [DashboardController::class, 'setPortal'])->name('set-portal');
        Route::get('/gettime', [KirimController::class, 'getendtime']);

        // route laporan
       // Route::get('dashboard/laporan', [LaporanController::class, 'cetakLaporan'])->name('cetak');
        Route::post('/dashboard/laporan', [LaporanController::class, 'filter', 'laporanAgama', 'showTable'])->name('laporanFilter');
        Route::get('dashboard/laporan', [LaporanController::class, 'laporan'])->name('laporan-data')->defaults('title', 'Laporan Siswa');
        Route::get ('/dahboard/laporan', [LaporanController::class,'cetakLaporan'])->name('cetak');
    });

    Route::group([
        'middleware' => 'role:sekolah'
    ], function () {
        // Yang login adalah sekolah/operator sekolah
        // Masuk ke dashboard sekolah
        Route::get('/sekolah/{slug}', [SekolahController::class, 'dashboardSekolah'])->name('sekolah')->defaults('title', 'Sekolah Dashoard');

        // Masuk ke tampilan upload file
        Route::get('/sekolah/upload/{slug}', [KirimController::class, 'kirim_file'])->name('upload-view')->defaults('title', 'Upload File');

        // Fungsi untuk post file
        Route::post('/uploadFile/{slug}', [KirimController::class, 'postFile'])->name('upload');

        // Tampilan ketika berhasil post file
        Route::get('/success', [DashboardController::class, 'sukses'])->name('sukses')->defaults('title', 'Sukses');

        // Hapus kiriman
        Route::delete('/sekolah/hapus/{id}', [KirimController::class, 'deleteFile'])->name('hapus-file');
        Route::get('/sekolah/{id}', [DataController::class, 'showdelete'])->name('data.delete');

        // Masuk ke tampilan data siswa
        Route::get('/sekolah/data/{slug}', [SiswaController::class, 'detailSiswa'])->name('data-siswa')->defaults('title', 'Data-Siswa');

        // Masuk ke halaman history
        Route::get('/riwayat-kirim/sekolah/{slug}/', [SekolahController::class, 'history'])->name('riwayat-kirim')->defaults('title', 'Riwayat Kirim');

        Route::get('/template-excel', [SekolahController::class, 'downloadTemplate'])->name('template-excel');
    });

    Auth::routes();
});
