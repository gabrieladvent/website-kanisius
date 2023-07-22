@extends('layout-yayasan.second')
@section('isi-content')
<section class="content-akun">
  <div class="container-fluid">
      <form action="{{ route('dashboard.store') }}" method="POST">
          @csrf
          <div class="row">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Buat Akun</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter ID" name="id">
                            @error('id')
                              <small>{{ $message }}</small>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter nama" name="nama">
                            @error('nama')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
                            @error('email')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            @error('password')
                            <small>{{ $message }}</small>
                            @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Sekolah</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Nama Sekoah" name="namasekolah">
                        @error('namasekolah')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                    </div>
                    <div class="form-group">
                        <div class="radio-container">
                            <input type="radio" name="status" value="Sekolah" id="sekolah">
                            <label for="Sekolah">Operator Sekolah</label>
                        </div>
                        <div class="radio-container">
                            <input type="radio" name="status" value="Yayasan" id="yayasan">
                            <label for="Yayasan">Operator Yayasan</label>
                        </div>
                        @error('status')
                        <small>{{ $message }}</small>
                        @enderror
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