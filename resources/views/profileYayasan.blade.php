@extends('layout-yayasan.second')
@section('isi-content')
   <div class="row px-5">
        <div class="col-4  mt-2 ms-4">
            <div class="row mt-5 shadow-3-strong bg-light">
                <div class="col mt-3 ms-1">
                    <div>
                        <label class="ms-2">ID User</label>
                        <p class="ms-2 fw-bold fs-5"> {{ $user->id }} </p>
                    </div>
                    <div class="">
                        <label class="ms-2">Nama User</label>
                        <p class="ms-2 border border-secondary-subtle fw-bold fs-5"> {{ $user->name }} </p>
                    </div>
                    <div class="">
                        <label class="ms-2">Nama Sekolah</label>
                        <p class="ms-2 fw-bold fs-5">{{ $user->namasekolah }}</p>
                    </div>
                </div>
                <div class="col mt-5">
                    <img class="float-end mb-4" src="{{ asset('/image/foto-profile.png') }}" width="150px" alt="">
                </div>
            </div>

            <div class="row mt-3 d-flex shadow-3-strong bg-light mb-5">
                <table class="ms-3 mt-4">
                    <tr>
                        <td>
                            <input type="checkbox" id="edit-checkbox" onchange="toggleInputs()">
                        </td>
                        <td>
                            <label for="edit-checkbox" class="text-p-yayasan">Edit Profile</label>
                        </td>
                    </tr>
                </table>
                <div>
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
                                    id="exampleInputPassword1" autocomplete="current-password" style="width: 28vw;">
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

        <div class="col mt-2">
            <div class="row mt-5  ms-5 justify-content-center shadow-3-strong bg-light">
                <div class="col-3 mt-3 mb-3  text-center">
                        <a href="akun-yayasan" class="btn bg-primary text-white">Daftar Akun Operator</a>
                </div>
                <div class="col-3 mt-3 mb-3  text-center">
                        <a href="{{ route('portal-view') }}" class="btn bg-success text-white ">Portal Upload File</a>
                </div>
            </div>

            <div class="row mt-3 mb-5 ms-5 d-flex shadow-3-strong bg-light ">
                <p class="text-center fs-5">Upload Tema Disini</p>
                <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <fieldset class="upload_dropZone text-center mb-2 p-2">
                        <legend class="visually-hidden">Image uploader</legend>
                        <svg class="upload_svg" width="60" height="60" aria-hidden="true">
                            <use href="#icon-imageUpload"></use>
                        </svg>
                        <p class="small my-2">Drag &amp; Drop tema gambar(s) dengan format png<br><i>or</i>
                        </p>
                        <input id="upload_image_background" data-post-name="image_background"
                            data-post-url="{{ route('update.profile') }}" class="position-absolute invisible" type="file"
                            name="photo" multiple accept="image/png" />
                        <label class="btn btn-upload mb-3" for="upload_image_background">Choose
                            file(s)</label>
                        <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0"></div>
                    </fieldset>
                    <div class="row">
                        <div class="col mt-1 mb-3">
                            <button type="submit" class=" float-end fs-6 btn bg-primary text-white">Submit</button>
                        </div>
                    </div>
                </form>

                <svg style="display:none">
                    <defs>
                        <symbol id="icon-imageUpload" clip-rule="evenodd" viewBox="0 0 96 96">
                            <path
                                d="M47 6a21 21 0 0 0-12.3 3.8c-2.7 2.1-4.4 5-4.7 7.1-5.8 1.2-10.3 5.6-10.3 10.6 0 6 5.8 11 13 11h12.6V22.7l-7.1 6.8c-.4.3-.9.5-1.4.5-1 0-2-.8-2-1.7 0-.4.3-.9.6-1.2l10.3-8.8c.3-.4.8-.6 1.3-.6.6 0 1 .2 1.4.6l10.2 8.8c.4.3.6.8.6 1.2 0 1-.9 1.7-2 1.7-.5 0-1-.2-1.3-.5l-7.2-6.8v15.6h14.4c6.1 0 11.2-4.1 11.2-9.4 0-5-4-8.8-9.5-9.4C63.8 11.8 56 5.8 47 6Zm-1.7 42.7V38.4h3.4v10.3c0 .8-.7 1.5-1.7 1.5s-1.7-.7-1.7-1.5Z M27 49c-4 0-7 2-7 6v29c0 3 3 6 6 6h42c3 0 6-3 6-6V55c0-4-3-6-7-6H28Zm41 3c1 0 3 1 3 3v19l-13-6a2 2 0 0 0-2 0L44 79l-10-5a2 2 0 0 0-2 0l-9 7V55c0-2 2-3 4-3h41Z M40 62c0 2-2 4-5 4s-5-2-5-4 2-4 5-4 5 2 5 4Z" />
                        </symbol>
                    </defs>
                </svg>

            </div>
        </div>
    </div>
@endsection
