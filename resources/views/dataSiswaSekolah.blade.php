<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    <title>Data Siswa</title>

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
      
    <!-- isi -->
    <div class="">
        <div class="judul" style="margin-top: 8%;">
            <p class="fs-3 fw-bold text-wrap text-center">Data Siswa-Siswi SD Sangken</p>
            <p class="fs-3 fw-bold text-wrap text-center" >Tahun Ajaran 2023/2024</p>
        </div>
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
          <div class="dropdown" style="margin-left: 12vw;">
            <select id="dropdown1" class="dropdown-select">
              <option selected>Bulan</option>
              <option value="opsi1">Januari</option>
              <option value="opsi2">Februari</option>
              <option value="opsi4">Maret</option>
              <option value="opsi5">April</option>
              <option value="opsi6">Mei</option>
              <option value="opsi7">Juni</option>
              <option value="opsi8">Juli</option>
              <option value="opsi9">Agustus</option>
              <option value="opsi10">September</option>
              <option value="opsi11">November</option>
              <option value="opsi12">Desember</option>
            </select>
            <select id="dropdown2" class="dropdown-select">
              <option selected>Tahun</option>
              <option value="pilihan1">2022</option>
              <option value="pilihan2">2023</option>
              <option value="pilihan3">2024</option>
            </select>
          </div>
          {{-- <div class="filter">
            <button type="button" class="btn btn-primary">Filter</button>
          </div> --}}
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
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($data_siswa as $item)
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
            </tbody>
            <tfoot>
                <tr>
                  <th>NISN</th>
                  <th>Nama Siswa</th>
                  <th>Tanggal Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Kelas</th>
                </tr>
            </tfoot>
        </table>
        </div>
      </div>
    </div>

    <!-- pop up -->
    <div class="filter-popup" id="filterPopup">
      <h4>Filter Options</h4>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="Laki-Laki" id="option1">
        <label class="form-check-label" for="option1">
          Laki-Laki
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="Perempuan" id="option2">
        <label class="form-check-label" for="option2">
          Perempuan
        </label>
      </div>
      <button type="button" class="btn btn-primary" id="applyBtn">Apply</button>
      <button type="button" class="btn btn-secondary" id="closeBtn">Close</button>
    </div>

    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ asset('/js/jsDataSiswaSekolah.js') }}"></script>
</body>
</html>