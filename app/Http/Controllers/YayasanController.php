<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Yayasan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\SessionGuard;

class YayasanController extends Controller
{
    public function kiriman($title) {
        return view('tablesekolah', compact('title'));
    }

    public function update(Request $request)
    {
        // Validasi input jika diperlukan

        $yayasan = DB::table('yayasan')->where('id','nama_foto')->first();
        $request->validate([
            // ... Validasi lainnya ...
            'nama_foto' => 'image|mimes:png',
        ]);

        // Dapatkan record yayasan berdasarkan ID yang ingin diperbarui
      

        if ($request->hasFile('nama_foto')) {
            // Hapus foto profil sebelumnya jika ada
              ($yayasan->nama_foto)->delete();

            // Upload foto profil baru
            $path = $request->file('nama_foto')->store('image', 'public');
            $yayasan->nama_foto = $path;
        }

        // Simpan perubahan pada data profil
        // ... Simpan data profil lainnya ...

        $yayasan->save();

      //  return back()->with('success', 'Profil berhasil diperbarui!');
    }

//     public function addProfilePhoto(Request $request)
// {
//     // Validasi input jika diperlukan
//     $request->validate([
//         'nama_foto  ' => 'required|image|mimes:png,jpg,jpeg|max:2048',
//     ]);

//     // Dapatkan record yayasan berdasarkan user yang sedang login
//     $yayasan = DB::table('yayasan'); // Pastikan bahwa ada relasi 'yayasan' pada model User (atau sesuaikan dengan relasi yang benar)

//     if ($yayasan->nama_foto) {
//         Storage::delete($yayasan->nama_foto);
//     }

//     // Simpan foto baru
//     $path = $request->file('nama_foto')->store('image', 'public');

//     // Update kolom profile_picture pada tabel users
//     $yayasan->update([
//         'nama_foto' => $path,
//     ]);
//     $yayasan->save();

//     dd('gagal');
//     //return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
// }
}
