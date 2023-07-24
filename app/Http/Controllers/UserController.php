<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request, $title) {
        $user = Auth::user();
        return view('profile', compact('user', 'title'));
    }

    public function akun_yayasan(){
        $data = User::paginate(10);
        return view('akunYayasan', compact('data', 'title'));
    }

    public function edit(Request $request, $id, $title){
        $data = User::find($id);
        return view('editAkun', compact('data', 'title'));
    }

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

        return redirect()->route('login');
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'name'  => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

            $data['id'] = $request->id;
            $data['name'] = $request->name;
            $data['email'] = $request->email;

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);
        return redirect()->route('akun-yayasan');
    }

    public function delete(Request $request, $id) {
        $data = User::find($id);

        if($data){
            $data->delete();
        }
        return redirect()->route('akun-yayasan');
    }
}
