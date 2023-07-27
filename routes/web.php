<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KirimController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\YayasanController;

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

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Masuk ke tampilan profile
Route::get('dashboard/profile', [DashboardController::class, 'profile'])->name('profile');


// Yang login adalah admin/yayasan
//Masuk dashboard yayasan
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard')->defaults('title', 'Dashboard');

// Masuk ke tampil data
Route::get('dashboard/data/', [SiswaController::class, 'index'])->name('dashboard.data')->defaults('title', 'Data Siswa')->middleware('role:yayasan');

// Masuk ke tampilan update file
Route::get('/dashboard/kiriman-data', [YayasanController::class, 'kiriman'])->name('kiriman-data')->defaults('title', 'Update Data')->middleware('role:yayasan');

// Masuk ke tampilan notifikasi
Route::get('dashboard/notifikasi', [DashboardController::class, 'showNotifikasi'])->name('notifikasi')->defaults('title', 'Pesan')->middleware('role:yayasan');
Route::get('/dashboard/kiriman-data', [YayasanController::class, 'kiriman'])->name('kiriman-data')->defaults('title', 'Update Data');

// Masuk ke tampilan notifikasi
Route::get('dashboard/notifikasi', [DashboardController::class, 'showNotifikasi'])->name('notifikasi')->defaults('title', 'Pesan');

// Masuk ke tampilan akun-akun operator
Route::get('dashboard/akun-yayasan', [UserController::class, 'akun_yayasan'])->name('akun-yayasan')->defaults('title', 'Akun Operator')->middleware('role:yayasan');

// Masuk ke tampilan edit profile untuk akun operator sekolah
Route::get('dashboard/edit/{id}', [UserController::class, 'edit'])->name('dashboard.edit')->defaults('title', 'Edit Akun')->middleware('role:yayasan');

// fungsi untuk update data
Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware('role:yayasan');

// Fungsi untuk hapus akun
Route::delete('dashboard/delete/{id}', [UserController::class, 'delete'])->name('dashboard.delete')->middleware('role:yayasan');

// Fungsi untuk update tema
Route::post('/updateaction/{id}', [YayasanController::class, 'update'])->name('update.profile');

// Route tambah akun
Route::get('/dashboard/tambah-akun', function () {
    return view('auth.register', [
        'title' => 'Tambah Akun'
    ]);
})->name('tambah-akun')->middleware('role:yayasan');

// Route untuk ganti tema
Route::post('/updateaction', [YayasanController::class, 'update'])->name('update.profile');


// Yang login adalah sekolah/operator sekolah
// Masuk ke dashboard sekolah
Route::get('/sekolah/{slug}', [SiswaController::class, 'dashboardSekolah'])->name('sekolah')->defaults('title', 'SekolahDashoard')->middleware('role:sekolah');

// Masuk ke tampilan upload file
Route::get('/sekolah/upload/{slug}', [KirimController::class, 'kirim_file'])->name('upload-view')->defaults('title', 'Upload File');

// Fungsi untuk post file
Route::post('/uploadFile/{slug}', [KirimController::class, 'postFile'])->name('upload');

// Tampilan ketika berhasil post file
Route::get('/success', [DashboardController::class, 'sukses'])->name('sukses')->defaults('title', 'Sukses')->middleware('role:sekolah');

// Hapus kiriman
Route::delete('/sekolah/hapus/{id}', [KirimController::class, 'deleteFile'])->name('hapus-file');
Route::get('/sekolah/{id}', [DataController::class, 'showdelete'])->name('data.delete');

// Edit kiriman

// Masuk ke tampilan data siswa
Route::get('/sekolah/data/{slug}', [SiswaController::class, 'detailSiswa'])->name('data-siswa')->defaults('title', 'Data-Siswa')->middleware('role:sekolah');

// fungsi untuk update profile sekolah
Route::put('/update/{id}', [UserController::class, 'update_sekolah'])->name('update');


Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// route berhasil
// Route::get('/success', function () {
//     if (session()->has('upload_sukses')) {
//         return view('uploadsucess');
//     } else {
//         return redirect()->back();
//     }
// })->name('success')->middleware('web');


