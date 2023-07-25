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

// Route untuk login
    Route::get('/', [LoginController::class, 'index'])->name('login');
   // Route::get('/loginaction', [LoginController::class, 'actionlogin'])->name('actionlogin');
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
    // Masuk ke tampilan profile
       // Route::get('dashboard/profile', [UserController::class, 'index'])->name('profile')->defaults('title', 'Profile');

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
    Route::post('/updateaction', [YayasanController::class, 'update'])->name('update.profile');
    //Route::get('/viewupdate/{id}', [YayasanController::class, 'showUpdateForm'])->name('showUpdateForm');
    //Route::get('/updatetema/{id}', [YayasanController::class, 'showUpdateForm']);
    


// Yang login adalah sekolah/operator sekolah
    // Masuk ke dashboard sekolah
        Route::get('/sekolah/{nomor_s}', [SiswaController::class, 'dashboardSekolah'])->name('sekolah')->defaults('title', 'SekolahDashoard')->middleware('role:sekolah');
    // Masuk ke tampilan upload file
        Route::get('/sekolah/upload/{nomor_s}', [KirimController::class, 'kirim_file'])->name('upload-view')->defaults('title', 'Upload File');
        // Fungsi untuk post file
            Route::post('/uploadFile/{nomor_s}', [KirimController::class, 'postFile'])->name('upload');
        // Tampilan ketika berhasil post file
            Route::get('/success', function(){
                return view('uploadsucess')->middleware('role:sekolah');
            })->name('success');
    // Masuk ke tampilan data siswa

        Route::get('/sekolah/data/{nomor_s}', [SiswaController::class, 'detailSiswa'])->name('data-siswa')->defaults('title', 'Data-Siswa')->middleware('role:sekolah');


        Route::get('/sekolah/data/{nomor_s}', [SiswaController::class, 'detailSiswa'])->name('data-siswa')->defaults('title', 'Data-Siswa');
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






//role yayasan
// Route::middleware('role:admin,editor')->group(function () {
//     Route::get('/profile/{id}', 'ProfileController@show')->name('profile');
// });
//     Route::get('dashboard/data/', [SiswaController::class, 'index'])->middleware('role:yayasan');
//     Route::get('dashboard/edit/{id}', [UserController::class, 'edit'])->name('dashboard.edit')->middleware('role:yayasan');
//     Route::get('dashboard/akun-yayasan', [UserController::class, 'akun_yayasan'])->name('akun-yayasan')->middleware('role:yayasan');
//     Route::get('dashboard', [LoginController::class, 'dashboard'])->name('akun-yayasan')->middleware('role:yayasan');
//     Route::post('/store', [UserController::class, 'create'])->name('store')->middleware('role:yayasan');

// //role login
// Route::post('/uploadFile', [KirimController::class, 'postFile'])->middleware('role:sekolah');;
// Route::get('sekolah/{nomor_s}/upload/', function () {
//     return view('uploadfile');
// })->middleware('role:sekolah');
// Route::get('/sekolah/{nomor_s}', [SiswaController::class, 'dashboardSekolah'])->name('sekolah')->middleware('role:sekolah');
// Route::get('/sekolah/data/{nomor_s}', [SiswaController::class, 'detailSiswa'])->middleware('role:sekolah');
// Route::post('/remove', [KirimController::class, 'removeFile'])->middleware('role:sekolah');


// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('dashboard/profile', [UserController::class, 'index'])->name('profile');
// Route::get('/login', [LoginController::class, 'index'])->name('login');


