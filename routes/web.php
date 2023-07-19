<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\KirimController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('login');
// });

//Route::get('/login', 'App\Http\Controllers\Controller@login_proses')->name('login');
// Route::post('login', [Controller::class, 'authenticate'])->name('login.action');

// Route::middleware(['auth', 'role:yayasan'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
      
//     });
// });
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('role:yayasan,yayasan');

Route::get('/homesekolah', function () {
    return view('homeSekolah');
})->middleware('role:sekolah,sekolah');





Route::get('/login', [LoginController::class, 'index'])->name('login');
//Route::get('/sekolah', 'App\Http\Controllers\LoginController@sekolah')->name('sekolah');


//Memanggil dan jika login sebagai sekolah
Route::get('/sekolah/{nomor_s}', [SiswaController::class, 'dashboardSekolah'])->name('sekolah');
//Masuk ke dalam menu tampil data sekolah
Route::get('/sekolah/data/{nomor_s}', [SiswaController::class, 'detailSiswa']);




//Ketika yayasan masuk ke dalam menu tampil data siswa
Route::get('dashboard/data/', [SiswaController::class, 'index']);


// Ketika upload file
Route::post('/uploadFile', [KirimController::class, 'postFile']);
Route::get('sekolah/{nomor_s}/upload/', function () {
    return view('uploadfile');
});

// route berhasil
// Route::get('/success', function () {
//     if (session()->has('upload_sukses')) {
//         return view('uploadsucess');
//     } else {
//         return redirect()->back();
//     }
// })->name('success')->middleware('web');

// Route::get('/success', function(){
//     return view('uploadsucess');
// })->name('success');

// Remove submitted
Route::post('/remove', [KirimController::class, 'removeFile']);





// route untukk akun
Route::get('dashboard/profile', [UserController::class, 'index'])->name('profile');
Route::get('dashboard/akun-yayasan', [UserController::class, 'akun_yayasan'])->name('akun-yayasan');

// Route untuk edit akun
Route::get('dashboard/edit/{id}', [UserController::class, 'edit'])->name('dashboard.edit');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
