<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request) {
        $data= User::get();
        return view('profile', compact('data'));
    }

    public function akun_yayasan(){
        $data = User::paginate(10);
        return view('akunYayasan', compact('data'));
    }

    public function edit(Request $request, $id){
        $data = User::find($id);
        return view('editAkun', compact('data'));
    }
}
