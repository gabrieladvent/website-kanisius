<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Akun | Yayasan</title>
    <link href="{{ asset('/image/logo.png') }}" rel="icon">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="{{ asset('/css/styleHomeSekolah.css') }}"/>
</head>
<body style="background-color: #fcf2fc;">
    <section>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
          <div class="container-fluid">
            <button
              class="navbar-toggler"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#navbarRightAlignExample"
              aria-controls="navbarRightAlignExample"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <i class="fas fa-bars"></i>
            </button>
      
            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarRightAlignExample">
              <div class="row">
                <div class="col-lg-12 ms-5">
                  <img src="{{ asset('/image/logo.png') }}" style="width: 3%;">
                  <img src="{{ asset('/image/HITAM.png') }}" style="width: 15%; margin-left: 1%; margin-top: 1%">
                </div>
              </div>
              <!-- Left links -->
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-nowrap">
                <li class="nav-item">
                  <a class="inter nav-link active" aria-current="page" href="#">Video Tutorial</a>
                </li>
                <li class="nav-item">
                  <a class="inter nav-link text-dark" href="#">Dokumentasi</a>
                </li>
                <li class="nav-item">
                  <a class="inter nav-link text-dark" href="#">Kontak Admin</a>
                </li>
              </ul>
              <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->
          </div>
          <!-- Container wrapper -->
        </nav>
      </section>

       <!-- sidebar -->
       <nav class="main-menu">
        <ul>
            <li>
                <a href="/sekolah/2032" class="icon"><img src="{{ asset('/icon/house-solid.svg') }}" alt=""></a>
            </li>


            <li>
              <a href="#" class="icon"><img src="{{ asset('/icon/paper-plane-solid.svg') }}" alt=""></a>
            </li>
            <li>
              <a href="dataSiswaSekolah.blade.html" class="icon"><img src="{{ asset('/icon/user-group-solid.svg') }}" alt=""></a>
            </li>
            <li>
              <a href="#" class="icon"><img src="{{ asset('/icon/bell-solid.svg') }}" alt=""></a>
            </li>
        </ul>

        <ul class="logout">
            <li>
              <a href="#" class="icon"><img src="{{ asset('/icon/user-tie-solid.svg') }}" alt=""></a>
            </li> 
            <li>
              <a href="#" class="icon"><img src="{{ ('/icon/gear-solid.svg') }}" alt=""></a>
           </li>  
        </ul>
    </nav>

        {{-- isi --}}

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
</body>
</html>