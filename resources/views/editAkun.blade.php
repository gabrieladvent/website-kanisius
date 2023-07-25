@extends('layout-yayasan.second')
@section('isi-content')
<section class="content-akun">
    <div class="container-fluid">
        <form action="{{ route('user.update', ['id' => $data->id]) }}" method="POST">
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
                                <input type="text" class="form-control" id="nomorID" placeholder="Masukan ID"
                                    name="id" value="{{ $data->id }}">
                                @error('id')
                                    <small>{{ $message }}</small>
                                @enderror
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
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter nama" name="name" value="{{ $data->name }}">
                                @error('nama')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Password">
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

{{-- @section('isi-content')
    
@endsection --}}
