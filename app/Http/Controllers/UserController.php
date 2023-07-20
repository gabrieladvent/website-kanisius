<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    // public function store(Request $request){
    //     // dd('masuk');
    //     $validator = Validator::make($request->all(),[
    //         // 'id' => 'required',
    //         'nama'  => 'required',
    //         'email' => 'required',
    //         'password' => 'required',
    //         'namasekolah' => 'required',
    //         'status' => 'required'
    //     ]);
        

    //     if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

    //     // $data['ID'] = $request->id;
    //     $data['name'] = $request->nama;
    //     $data['email'] = $request->email;
    //     $data['password'] = Hash::make($request->password);
    //     $data['namasekolah'] = $request->namasekolah;
    //     $data['status'] = $request->input('status');
    //     User::create($data);
    //     return redirect()->route('/dashboard');
    // }
    
    public function validator(array $data) {
        return Validator::make($data,[
            'id' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'namasekolah' => ['required', 'string'],
            'status' => ['required'],
        ]);
    }

    public function create(Request $request)
    {
            $data['id'] = $request->id;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);
            $data['namasekolah'] = $request->namasekolah;
            $data['status'] = $request->input('status');
        User::create($data);

        return view('/dashboard');
    }
}
