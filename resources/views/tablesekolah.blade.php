<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kiriman | Yayasan</title>
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />

    <!-- link css -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/mdb.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/addons/datatables.min.css">
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
          <a href="{{ route('kiriman-data') }}" class="icon"><img src="{{ asset('/icon/database-solid.svg') }}" alt=""></a>
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

        </div>
  
        <div class="">
          <div class="judul" style="margin-top: 8%;">
            <p class="fs-3 fw-bold text-wrap text-center">Data Siswa-Siswi SD Sangken</p>
            <p class="fs-3 fw-bold text-wrap text-center" >Tahun Ajaran 2023/2024</p>
          </div>
        </div>
        
        
        <div class="data-siswa py-3 ">
          <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
            <table id="example" class="table table-bordered" style="width:100%">
              <thead>
                  <tr>
                      <th>NISN</th>
                      <th>Nama Siswa</th>
                      <th>Tanggal Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Nama Sekolah</th>
                      <th>Kelas</th>
                  </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                </tr>
                {{-- @foreach ($data_siswa as $item)
                    <tr>
                        <td>{{ $item->NISN }}</td>
                        <td>{{ $item->Nama }}</td>
                        <td>{{ $item->Tanggal_Lahir }}</td>
                        <td>
                            @if ($item->JK == 'L')
                                Laki-Laki
                            @elseif ($item->JK == 'P')
                                Perempuan
                            @endif
                        </td>
                        <td>{{ $item->sekolah->NAMASEKOLAH }}</td>
                        <td>{{ $item->Rombel_Set_Ini }}</td>
                    </tr>
                @endforeach --}}
              </tbody>
              <tfoot>
                  <tr>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Nama Sekolah</th>
                    <th>Kelas</th>
                  </tr>
              </tfoot>
          </table>
          </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center mt-5 ms-5">
        <div class="col-2 justify-content-center">
            <a href="" class="btn bg-dark text-white">Update Data</a>
        </div>
        <div class="col-3 justify-content-center">
            <a href="" class="btn bg-light text-dark">Download Dan Upload</a>
        </div>
    </div>
</div>
        </div>
    </section>
    
  
  
  <!--Main layout-->
 <!-- MDB -->
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
 <script type="text/javascript" src="./js/popper.js"></script>
 <script type="text/javascript" src="./js/bootstrap.min.js"></script>
 <script type="text/javascript" src="./js/mdb.min.js"></script>
 <script type="text/javascript" src="./js/jquery.min.js"></script>
 <script type="text/javascript" src="./js/addons/datatables.min.js"></script>
 <script type="text/javascript">
     $(document).ready(function () {
         $('#dtBasicExample').DataTable();
         $('.dataTables_length').addClass('bs-select');
     });
 </script>
</body>

</html>