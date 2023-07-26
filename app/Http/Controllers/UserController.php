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
    public function index(Request $request, $title)
    {
        $user = Auth::user();
        return view('profile', compact('user', 'title'));
    }

    public function akun_yayasan($title)
    {
        $data = User::paginate(10);
        return view('akunYayasan', compact('data', 'title'));
    }

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

        return redirect()->route('akun-yayasan');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name'  => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['email'] = $request->email;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);
        return redirect()->route('akun-yayasan');
    }

    public function delete($id)
    {
        $data = User::find($id);

        if ($data) {
            $data->delete();
        }
        return redirect()->route('akun-yayasan');
    }

    public function update_sekolah(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'password' => 'nullable',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['name'] = $request->name;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);
        return redirect()->route('profile');
    }
}
