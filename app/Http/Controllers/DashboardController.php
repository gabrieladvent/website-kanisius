<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use App\Models\Portal;
use App\Models\Sekolah;
use App\Models\Yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{
    /*
        Method untuk menampilkan notifikasi atau message dari blade notifikasi
    */
    public function showNotifikasi($title)
    {

        $notifikasi = Kirim::all();
        $users = User::pluck('namasekolah', 'id');

        return view('notifikasi', compact('notifikasi', 'users', 'title'))->with('isFromShow', true);
    }

    /*
        Method untuk menampilkan daftar sekolah namun menggunakan blade notifikasi
    */
    public function daftarSekolah($title)
    {
        $dataSekolah = Sekolah::all();

        return view('notifikasi', compact('dataSekolah', 'title'))->with('isFromShow', false);
    }

    /*
        Method untuk menampilkan profil berdasarkan authentic yang sedang login
    */
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

    /*
        Menampilkan halaman sukses
    */
    public function sukses($title)
    {
         $user = Auth::user();
         $files = Storage::files('simpanFile');

         $user_kirim = $user->id;
        $kirim = Kirim::where('ID', $user_kirim)->latest()->first();
        return view('uploadsucess',['files' => $files], compact('kirim','title','user'));
    }

    public function portal_view($title)
    {
        $time =  DB::table('portal')->get();
        return view('portal', compact('title','time'));
    }

    /*
        Method untuk menset dan update portal pengumpulan dari admin
    */
    public function setPortal(Request $request)
    {
        try {
            $request->validate([
                'file_name' => 'required|string',
                'upload_start' => 'required|date_format:Y-m-d\TH:i',
                'upload_end' => 'required|date_format:Y-m-d\TH:i|after:upload_start',
            ]);

            // Set session data
            Session::put('upload_start', $request->upload_start);
            Session::put('upload_end', $request->upload_end);

            // Portal::create([
            //     'nama_portal' => $request->file_name,
            //     'upload_start' => $request->upload_start,
            //     'upload_end' => $request->upload_end,
            // ]);

            $portalId = 1;
            Portal::where('id', $portalId)
                ->update([
                    'nama_portal' => $request->file_name,
                    'upload_start' => $request->upload_start,
                    'upload_end' => $request->upload_end,
                ]);


            return redirect()->route('portal-view')
                ->with('success', 'Waktu unggah berhasil diatur.');
        } catch (\Exception $e) {
            return redirect()->route('portal-view')
                ->with('error', 'Gagal Mengatur Waktu Portal');
        }
    }
}
