@extends('layout-yayasan.second')
@section('isi-content')
<section class="content-akun">
    <div class="container-fluid">
        <form action="{{ route('update-user', ['id' => $data->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nomorID">Nomor ID</label>
                                <input disabled type="text" class="form-control" id="" placeholder="Masukan ID"
                                    name="" value="{{ $data->id }}">
                                @error('id')
                                    <small>{{ $message }}</small>
                                @enderror
                                <input hidden type="text" name="id" id="nomorId" value="{{ $data->id }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter email" name="email" value="{{ $data->email }}">
                                @error('email')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Operator</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter nama" name="name" value="{{ $data->name }}">
                                @error('nama')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Sekolah</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter nama" name="name" value="{{$data->namasekolah}}">
                                @error('nama')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Password"><i class="fa fa-eye-slash password-toggle1" id="togglePassword" style="cursor: pointer"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">Konfirmasi Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation"autocomplete="new-password"
                                    placeholder="Konfirmasi Password">
                                </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" style="margin-left:93%">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
