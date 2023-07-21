<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    <title>Akun Yayasan</title>

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
                <a href="/dashboard" class="icon"><img src="{{ asset('/icon/house-solid.svg') }}" alt=""></a>
            </li>

            <li>
              <a href="#lihatKiriman" class="icon"><img src="{{ asset('/icon/database-solid.svg') }}" alt=""></a>
            </li>
            <li>
              <a href="{{ route('dashboard.data') }}" class="icon"><img src="{{ asset('/icon/user-group-solid.svg') }}" alt=""></a>
            </li>
            <li>
              <a href="#notifikasi" class="icon"><img src="{{ asset('/icon/bell-solid.svg') }}" alt=""></a>
            </li>
            <li>
                <a href="#laporan" class="icon"><img src="{{ asset('/icon/book-solid.svg') }}" alt=""></a>
              </li>
        </ul>

        <ul class="logout">
            <li>
              <a href="{{ route('profile') }}" class="icon"><img src="{{ asset('/icon/user-tie-solid.svg') }}" alt=""></a>
            </li> 
            <li>
              <a href="{{ route('logout') }}" class="icon"><img src="{{ ('/icon/sign-out-alt-solid.svg') }}" alt=""></a>
           </li>  
        </ul>
    </nav>
      
    <!-- isi -->
    <div class="">
        <div class="judul" style="margin-top: 8%;">
            <p class="fs-3 fw-bold text-wrap text-center">Daftar Akun Operator Sekolah</p>
            <p class="fs-3 fw-bold text-wrap text-center" >Yayasan Kanisius</p>
        </div>
        
      </div>
      
      
      <div class="data-siswa py-3 ">
        <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
          <table id="example" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Username</th>
                    <th>Nama Sekolah</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($data as $item)
              @if ($item->status == 'sekolah')
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->namasekolah }}</td>
                <td>
                    <a href="{{ route('dashboard.edit', ['id' => $item->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i>Edit</a>

                    <a href="{{ route('dashboard.delete', ['id' => $item->id]) }}" class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Anda yakin ingin menghapus data ini?')) document.getElementById('delete-form-{{ $item->id }}').submit();">
                      <i class="fas fa-trash-alt"></i> Hapus
                  </a>
                  
                  <form id="delete-form-{{ $item->id }}" action="{{ route('dashboard.delete', ['id' => $item->id]) }}" method="POST" style="display: none;">
                      @csrf
                      @method('DELETE')
                  </form>
                  
                </td>
              </tr>
              {{-- <div class="modal fade" id="modal-hapus">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Ingin Hapus Data <b></b>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <form action="{{ route('dashboard.delete', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                      </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal --> --}}
              @endif          
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Username</th>
                    <th>Nama Sekolah</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
        </div>
      </div>
    </div>

    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ asset('/js/jsDataSiswaSekolah.js') }}"></script>
</body>
</html>