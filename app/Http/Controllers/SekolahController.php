<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SekolahController extends Controller
{
    public function history($title, $slug)
    {
        $user = Auth::user();
        // dd($user);
        $id = User::where('slug', $user->slug)->value('id');
        $data = Kirim::where('ID', $id)->get();
        // dd($data);
        return view('history', compact('title', 'user', 'data'));
    }

    public function showGoogleDriveLink()
    {
        $googleDriveLink = 'https://docs.google.com/document/d/1ovqEj16HJIwraspkz8b0HMr_50w9HKrPAh-8AemoOOA/edit?usp=drive_link'; // Ganti dengan link Google Drive yang sesuai

        return Redirect::to($googleDriveLink);
    }
}
