@extends('layout-sekolah.second')
@section('isi-content')
    <div class="row px-5">
        <div class="col-8 mt-5 py-4 px-5">
            <div class="row mt-5 shadow-3-strong ms-5 bg-white">
                <div class="col-8 mt-3">
                    <div>
                        <label class="ms-2 fw-bold" style="font-size: 1 vw">ID User</label>
                        <p class="text-p ms-2"> {{ $user->id }} </p>
                    </div>
                    <div class="">
                        <label class="ms-2 fw-bold" style="font-size: 1 vw">Nama User</label>
                        <p class="text-p ms-2"> {{ $user->name }} </p>
                    </div>
                    <div class="">
                        <label class="ms-2 fw-bold" style="font-size: 1 vw">Nama Sekolah</label>
                        <p class="text-p ms-2">{{ $user->namasekolah }}</p>
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
                        <div class="input-group mb-3">
                            <input disabled type="text" class="form-control" id="name" placeholder="Masukan Nama"
                                name="name" value="{{ $user->name }}">
                            @error('name')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <label for="exampleInput disabled ssword1">Password</label>
                        <div class="input-group mb-3">
                            <div class="password-container">
                                <input disabled type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    id="exampleInputPassword1" autocomplete="current-password" style="width: 24vw; position: flex;">
                                    <i class="fa fa-eye-slash password-toggle" id="togglePassword" style="cursor: pointer;"></i>
                            </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="password-confirm">Konfirmasi Password</label>
                        <input disabled id="password-confirm" type="password" class="form-control"
                            name="password_confirmation"autocomplete="new-password" placeholder="Konfirmasi Password">

                        <button type="submit" class="btn btn-primary float-end mt-3 mb-3">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
