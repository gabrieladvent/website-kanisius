<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SekolahController extends Controller
{
    public function history($title, $slug){
        $user = Auth::user();
        // dd($user);
        $id = User::where('slug', $user->slug)->value('id');
        $data = Kirim::where('ID', $id)->get();
        // dd($data);
        return view('history', compact('title', 'user', 'data'));
    }
}
