@extends('layout-sekolah.second')
@section('isi-content')
    <div class="row px-5">
        <div class="col-8  mt-5 py-4 px-5">
            <div class="row mt-5 shadow-3-strong ms-5 bg-white">
                <div class="col-8 mt-3">
                    <div>
                        <label class="ms-2">ID User</label>
                        <p class="text-p fw-bold ms-2"> {{ $user->id }} </p>
                    </div>
                    <div class="border border-secondary-subtle">
                        <label class="ms-2">Nama User</label>
                        <p class="text-p fw-bold ms-2"> {{ $user->name }} </p>
                    </div>
                    <div class="">
                        <label class="ms-2">Nama Sekolah</label>
                        <p class="text-p fw-bold ms-2">{{ $user->namasekolah }}</p>
                    </div>
                </div>
                <div class="col mt-4">
                    <img class="float-end mb-4" src="{{ asset('/image/foto-profile.png') }}" width="200px" alt="">
                </div>
            </div>
        </div>

        <div class="col mt-5 py-4 px-5">
            <div class="row mt-5 d-flex justify-content-center shadow-3-strong bg-white">
                <table class="ms-5 mt-4">
                    <tr>
                        <td>
                            <input type="checkbox" id="edit-checkbox" onchange="toggleInputs()">
                        </td>
                        <td>
                            <label for="edit-checkbox" class="text-p">Edit Profile</label>
                        </td>
                    </tr>
                </table>
                <div class="update-data mb-3">
                    <form action="{{ route('update', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="nomorID">Nama User</label>
                        <input disabled type="text" class="form-control" id="name" placeholder="Masukan Nama"
                            name="name" value="{{ $user->name }}">
                        @error('name')
                            <small>{{ $message }}</small>
                        @enderror

                        <label for="exampleInput disabled ssword1">Password</label>
                        <input disabled type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">

                        <label for="password-confirm">Konfirmasi Password</label>
                        <input disabled id="password-confirm" type="password" class="form-control"
                            name="password_confirmation"autocomplete="new-password" placeholder="Konfirmasi Password">

                        <button type="submit" class="btn btn-primary float-end mt-3">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
