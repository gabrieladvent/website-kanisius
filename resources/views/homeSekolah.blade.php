<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Dasboard Sekolah</title>
    <link href="{{ asset('/image/logo.png') }}" rel="icon">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="{{ '/css/styleHomeSekolah.css' }}"/>
  </head>

  <body style="background-color: #fcf2fc;">
    <section>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
              <div class="col-lg-12 mx-5">
                <h5 class="inter text">
                  Selamat Datang, <strong>SD Kanisius Sengkan</strong>
                </h5>
              </div>
            </div>
            <!-- Left links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="inter nav-link active" aria-current="page" href="#"
                  >Video Tutorial</a
                >
              </li>
              <li class="nav-item">
                <a class="inter nav-link text-dark" href="#">Dokumentasi</a>
              </li>
              <li class="nav-item">
                <a class="inter nav-link text-dark">Kontak Admin</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </section>
    
<!-- sidebar -->
        <nav class="main-menu">
            <ul>
                <li>
                    <a href="/sekolah/2032" class="icon"><img src="{{ asset('/icon/house-solid.svg') }}" alt=""></a>
                </li>
                <li>
                  <a href="/sekolah/2032/upload" class="icon"><img src="{{ asset('/icon/paper-plane-solid.svg') }}" alt=""></a>
                </li>
                <li>
                  <a href="/sekolah/data/2032" class="icon">
                    <img src="{{ asset('/icon/user-group-solid.svg') }}" alt="">
                  </a>
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
                  <a href="#" class="icon"><img src="{{ ('/icon/sign-out-alt-solid.svg') }}" alt=""></a>
               </li>  
            </ul>
        </nav>

    <!-- isi -->
    

  <div class="content">
    <div class="logo-banner">
      <table>
        {{-- <tr>
          <th> <i><img src="{{ asset('/image/logo.png') }}" class="img-kanisius"></i></th>
          <th>
            <i><img src="{{ asset('/image/alamat.png') }}" class="branding"> <span></span></i>
          </th>
          <th><i><img src="{{ asset('/image/IHS_Logo.png') }}" class="ihs-logo"></i></th>
        </tr> --}}

        <tr>
          <th> <i><img src="{{ asset('/image/logo.png') }}" class="img-kanisius-baru"></i></th>
          <th>
            <i><img src="{{ asset('/image/alamat.png') }}" class="branding-baru"> <span></span></i>
          </th>
          <th><i><img src="{{ asset('/image/ihs-baru.png') }}" class="ihs-logo-baru"></i></th>
        </tr>
        {{-- <tr>
          <th><img src="{{ asset('/image/ihs-baru.png') }}" alt=""></th>
        </tr> --}}
      </table>
    </div>
    <div class="data-siswa">
      <div class="judul" style="margin-top: 4%;">
          <p class="fs-3 fw-bold text-wrap text-center">Data Siswa-Siswi SD Sangken</p>
          <p class="fs-3 fw-bold text-wrap text-center" >Tahun Ajaran 2023/2024</p>
      </div>
      <div class=" table-data" style="margin-top: -1%; margin-left: 1%; margin-right:1%;">
        <table id="example" class="table table-striped" style="width:100%">
          <thead>
            <tr>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
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
                      <td>{{ $item->Rombel_Set_Ini }}</td>
                  </tr>
              @endforeach
              <tr>
                <td>NISN</td>
                <td>Nama Siswa</td>
                <td>Tanggal Lahir</td>
                <td>Jenis Kelamin</td>
                <td>Kelas</td>
              </tr>
              <tr>
                <td colspan="5">
                  <center><a href="/sekolah/data/2032">Lihat Lengkap</a></center>
                </td>
              </tr>
        </tbody>
        <tfoot>
            <tr>
              <th colspan="5" class="text-center">
              </th>
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
