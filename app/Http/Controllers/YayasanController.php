<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Yayasan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Str;

class YayasanController extends Controller
{
    public function kiriman($title) {
        return view('tablesekolah', compact('title'));
    }

    
    public function showUpdateForm($id)
    {
        $photo = Yayasan::findOrFail($id);
        return view('akunYayasan', compact('foto'));
    }
    
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'photo' => 'required|image|mimes:png|max:2048',
    //     ]);
    
    //     $photo = Yayasan::findOrFail($id);
    
    //     if ($request->hasFile('photo')) {
    //         // Hapus foto lama dari storage jika ada
    //         File::delete(public_path($photo->path));
    
    //         $file = $request->file('photo');
    //         $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
    //         Storage::putFileAs('photos', $file, $filename);
    
    //         // Update informasi foto di database
    //         DB::beginTransaction();
    //         try {
    //            // $photo->name = $file->getClientOriginalName();
    //             $photo->nama_foto = 'photos/' . $filename;
    //             $photo->save();
    //             DB::commit();
    
    //             return view('akunYayasan',compact('photo'))->with('success', 'Foto berhasil diupdate!');
    //         } catch (\Exception $e) {
    //             DB::rollback();
    //             return redirect()->back()->with('error', 'Gagal mengupdate foto.');
    //         }
    //     }
    
    //     return redirect()->back()->with('error', 'Gagal mengupdate foto.');
    // }

    public function update(Request $request)
    {
        $user = Auth::Yayasan();

        // Validasi input dari form
        $request->validate([
            'photo' => 'required|image|mimes:png|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Hapus foto profil lama jika ada
        if ($user->nama_foto) {
            Storage::delete($user->nama_foto);
        }

        // Simpan foto profil baru ke storage dan perbarui path-nya di database
        $profilePhotoPath = $request->file('photo')->store('images', 'public');
        $user->nama_foto = $profilePhotoPath;
        $user->save();

        return dd('sukses')->with('success', 'Foto profil berhasil diperbarui.');
    }


    public function upload(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('photos', $file, $filename);
    
            // Simpan informasi foto ke database
            DB::beginTransaction();
            try {
                $photo = new Yayasan();
               // $photo->name = $file->getClientOriginalName();
                $photo->nama_foto = 'photos/' . $filename;
                $photo->save();
                DB::commit();
    
                return redirect()->back()->with('success', 'Foto berhasil diupload!');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal mengupload foto.');
            }
        }
    
        return redirect()->back()->with('error', 'Gagal mengupload foto.');
    }
}
