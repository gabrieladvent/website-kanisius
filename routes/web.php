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


Route::get('/', [LoginController::class, 'index'])->name('login');
//role yayasan

    Route::get('dashboard/data/', [SiswaController::class, 'index']);
    Route::get('dashboard/edit/{id}', [UserController::class, 'edit'])->name('dashboard.edit');
    Route::get('dashboard/akun-yayasan', [UserController::class, 'akun_yayasan'])->name('akun-yayasan');
    Route::get('dashboard', [LoginController::class, 'dashboard'])->name('akun-yayasan');
    Route::post('/store', [UserController::class, 'create'])->name('store');






//role login
Route::post('/uploadFile', [KirimController::class, 'postFile']);
Route::get('sekolah/{nomor_s}/upload/', function () {
    return view('uploadfile');
});
Route::get('/sekolah/{nomor_s}', [SiswaController::class, 'dashboardSekolah'])->name('sekolah');
Route::get('/sekolah/data/{nomor_s}', [SiswaController::class, 'detailSiswa']);
Route::post('/remove', [KirimController::class, 'removeFile']);


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('dashboard/profile', [UserController::class, 'index'])->name('profile');
Route::get('/login', [LoginController::class, 'index'])->name('login');

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


