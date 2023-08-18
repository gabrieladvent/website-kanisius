<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use App\Models\Portal;
use App\Models\Sekolah;
use App\Models\Yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function showNotifikasi($title)
    {

        $notifikasi = Kirim::all();
        $users = User::pluck('namasekolah', 'id');

        return view('notifikasi', compact('notifikasi', 'users', 'title'))->with('isFromShow', true);
    }

    public function daftarSekolah($title)
    {
        $dataSekolah = Sekolah::all();

        return view('notifikasi', compact('dataSekolah', 'title'))->with('isFromShow', false);
    }


    public function profile(Request $request)
    {
        $user = Auth::user();
        if ($user->status == 'sekolah') {
            $sekolahId = $user->id;
            return $this->sekolah($sekolahId);
        } else {
            $title = "Profile Yayasan";
            return view('profileYayasan', compact('user', 'title'));
        }
    }

    public function sekolah($sekolahId)
    {
        $user = Auth::user();
        $title = "Profile Sekolah";
        return view('profileSekolah', compact('user', 'title'));
    }

    public function sukses($title)
    {
        $user = Auth::user();
        return view('uploadsucess', compact('title', 'user'));
    }

    public function portal_view (){
        return view('portal');
    }

    public function setPortal(Request $request){
        $request->validate([
            'file_name' => 'required|string',
            'upload_start' => 'required|date_format:Y-m-d\TH:i',
            'upload_end' => 'required|date_format:Y-m-d\TH:i|after:upload_start',
        ]);

        // Set session data
        Session::put('upload_start', $request->upload_start);
        Session::put('upload_end', $request->upload_end);

        $portalId = 3;
        Portal::where('id', $portalId)
        ->update([
            'nama_portal' => $request->file_name,
            'upload_start' => $request->upload_start,
            'upload_end' => $request->upload_end,
        ]);

    
        return redirect()->route('portal-view')
            ->with('success', 'Waktu unggah berhasil diatur.');
    }
    
}
