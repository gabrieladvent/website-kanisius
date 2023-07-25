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
use Illuminate\Support\Facades\File;

class YayasanController extends Controller
{
    public function kiriman($title) {
        return view('tablesekolah', compact('title'));
    }

    
    public function showUpdateForm($id)
    {
        $photo = yayasan::findOrFail($id);
        return view('akunYayasan', compact('photo'));
    }
    
    public function update(Request $request)
    {
       
        $request->validate([
            'photo' => 'required|image|mimes:png|max:2048',
        ]);
    
        $photo = Yayasan::find(1);

        if ($request->hasFile('photo')) {
            // Hapus foto lama dari storage jika ada
            File::delete(public_path($photo->nama_foto));
    
            $file = $request->file('photo');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('photo', $file, $filename);
    
            // Update informasi foto di database
            DB::beginTransaction();
            try {
               // $photo->name = $file->getClientOriginalName();
                 $photo->nama_foto = 'photo/' . $filename;
                $photo->save();
                DB::commit();
    
                return back()->with('success', 'Foto berhasil diupdate!');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal mengupdate foto.');
            }
        }
    
        return redirect()->back()->with('error', 'Gagal mengupdate foto.');
    }

 
//     public function upload(Request $request)
//     {
      
//         $request->validate([
//             'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);
    
//         if ($request->hasFile('photo')) {
//             $file = $request->file('photo');
//             $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
//             Storage::putFileAs('photos', $file, $filename);
    
//             // Simpan informasi foto ke database
//             DB::beginTransaction();
//             try {
//                 $photo = new Yayasan();
//                 //$photo->name = $file->getClientOriginalName();
//                 $photo->nama_foto = 'photos/' . $filename;
//                 $photo->save();
//                 DB::commit();
    
//             return redirect()->back()->with('success', 'Foto berhasil diupload!');
//             } catch (\Exception $e) {
//                 DB::rollback();
//                 return redirect()->back()->with('error', 'Gagal mengupload foto.');
//             }
//         }
    
//         return redirect()->back()->with('error', 'Gagal mengupload foto.');
//     }
 }
