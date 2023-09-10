<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class UserController extends Controller
{
    /* 
        Method untuk menampilkan daftar akun operator
    */
    public function akun_yayasan($title)
    {
        $data = User::where('status', 'sekolah')->get();
        return view('akunYayasan', compact('data', 'title'));
    }

    /* 
        Method untuk menampilkan view edit akun
    */
    public function edit(Request $request, $id, $title)
    {
        $data = User::find($id);
        $user = Auth::user();
        return view('editAkun', compact('data', 'title', 'user'));
    }


    public function validator(array $data)
    {
        return Validator::make($data, [
            'id' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'namasekolah' => ['required', 'string'],
            'status' => ['required'],
        ]);
    }

    /* 
        Method untuk create akun oleh yayasan
    */
    public function create(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'namasekolah' => 'required',
            'status' => 'required',
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan error
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Membuat data user dari input
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'namasekolah' => $request->namasekolah,
            'status' => $request->input('status'),
        ];
        $user = new User($data);
        // Menggunakan instance objek untuk mengakses method slugify melalui trait HasSlug
        $slugOptions = $user->getSlugOptions();
        $user->save();

        return redirect()->route('akun-yayasan')->with('success', 'Data Berhasil Ditambahkan');
    }

    /* Method untuk update akun operator oleh yayasan*/
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name'  => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'nullable|min:8'
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['email'] = $request->email;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);
        return redirect()->route('akun-yayasan')->with('success', 'Data Berhasil Diupdate');
    }

    /*  Method untuk hapus akun operator oleh yayasan*/
    public function delete($id)
    {
        $data = User::find($id);

        if ($data) {
            $data->delete();
            return redirect()->route('akun-yayasan')->with('success', 'Data Berhasil Dihapus');
        } else{
            return redirect()->back()->with('gagal', 'Data Gagal Dihapus');
        }
    }

    /* Method untuk update akun operator*/
    public function update_sekolah(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'password' => 'nullable',
            'password' => 'nullable|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'nullable|min:8',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);


        $data['name'] = $request->name;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);
        return redirect()->route('profile')->with('success', 'Akun Berhasil DiUpdate');
    }
}
