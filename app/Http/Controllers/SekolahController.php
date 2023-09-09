<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use App\Models\Siswa;
use App\Models\Siswa_TK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SekolahController extends Controller
{
    /*
        Method untuk melihat histori pengiriman
    */
    public function history($title, $slug)
    {
        $user = Auth::user();
        $id = User::where('slug', $user->slug)->value('id');
        $data = Kirim::where('ID', $id)->get();
        return view('history', compact('title', 'user', 'data'));
    }

    /*
        Method untuk menampilkan dashboard sekolah
    */
    public function dashboardSekolah($slug, $title)
    {
        // Dapatkan id siswa berdasarkan slug dari tabel User
        $id = User::where('slug', $slug)->value('id');

        // Dapatkan siswa-siswa dari tabel siswa yang memiliki nomor_s yang sama dengan id
        $data = Siswa::where('nomor_s', $id)->paginate(5);
        $user = Auth::user();
        $isTK = $user->namasekolah;
        $TK = Siswa_TK::where('NOMOR_S', $id)->paginate(5);

        if ($data) {
            return view('homeSekolah', compact('data', 'isTK', 'TK', 'title', 'user'));
        } else {
            return response('Siswa tidak ditemukan', 404);
        }
    }


    public function downloadTemplate()
    {
        $user = Auth::user();
        if($user->status == "sekolah" && (strpos($user->namasekolah, 'SD') === 0 || strpos($user->namasekolah, 'SMP') === 0)){
            $template = 'https://docs.google.com/spreadsheets/d/1VgZBJ4l7tjCDRkaiy-IgLaYKDShBS78F/edit?usp=sharing&ouid=115074841835460332215&rtpof=true&sd=true';

            return Redirect::to($template);
        } elseif($user->status == "sekolah" && (strpos($user->namasekolah, 'TK') === 0)){
            $template = 'https://docs.google.com/spreadsheets/d/1B7wiOVOrhwQXKvyH7Bk-GuMjKRGnQqLb/edit?usp=sharing&ouid=115074841835460332215&rtpof=true&sd=true';

            return Redirect::to($template);
        } else{
            abort(404, 'Gagal Mengeksekusi Perintah');
        }
    }

    public function panduan(){
        $user = Auth::user();
        if($user->status == 'sekolah'){
            $template = 'https://drive.google.com/file/d/1y8gGTZkyrwhXf2iAPKSGbhBkcB2aVT5b/view?usp=sharing';

            return Redirect::to($template);
        }elseif($user->status == 'yayasan'){
            $template = 'https://drive.google.com/file/d/1A_vU2UGD4y1q9KZc-A-Fp6RPE5XnLB_R/view?usp=sharing';

            return Redirect::to($template);
        }else{
            abort(404, 'Gagal Mengeksekusi Perintah');
        }
    }

    public function youTube(){
        $user = Auth::user();
        $user = Auth::user();
        if($user->status == 'sekolah'){
            $template = 'https://youtube.com/playlist?list=PLzqOhXLoR0dUEYwsuj4l7wBpGyOfvRIrp&si=FCTYRugo3aGzV9we';

            return Redirect::to($template);
        }elseif($user->status == 'yayasan'){
            $template = 'https://youtube.com/playlist?list=PLzqOhXLoR0dVNaW39dzfyd69b60U82T01&si=-EIiSQQyWEzOx1bQ';

            return Redirect::to($template);
        }else{
            abort(404, 'Gagal Mengeksekusi Perintah');
        }
    }
}
