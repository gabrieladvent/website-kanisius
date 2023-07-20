<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <!-- link css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/styleHomeSekolah.css') }}"/>
    <!-- link scss -->

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
                </header>
            </div>
            <div class="col">
                <div class="row mt-3 px-3 ">
                    <div class="col-3 ms-3">
                        <img src="{{ asset('/image/logo baru.png') }}" class="w-50 " alt="">
                    </div>
                    <div class="col-5 mt-5">
                        <img src="{{ asset('/image/alamat.png') }}" class="w-75" alt="">
                    </div>
                    <div class="col-3 ms-5">
                        <img src="{{ asset('/image/IHS_Logo.png') }}" class="w-75" alt="">
                    </div>
                    <div
                        class="row d-flex justify-content-center border-2 border-top border-primary mt-3 container-fluid shadow-6-strong ">
                        <div class="col-1 mt-4">
                            <p>Message</p>
                        </div>

                        <div class="col">
                            <table class="table table-borderless mt-3 w-100  " style="background-color: #F5F4F4;">
                                <tbody class=" mt-5">
                                    <tr class="border-bottom border-primary border-1">
                                        <th></th>
                                        <td>SD Kanisius Sanken mengirimkan file</td>
                                        <td><a href="" class="text-primary">Lihat</a></td>
                                        <td><a href="" class="text-primary">Download dan Upload</a></td>
                                    </tr>
                                    <tr class="border-bottom border-primary border-1">
                                        <th></th>
                                        <td>SD Kanisius Condong Catur </td>
                                        <td><a href="" class="text-primary">Lihat</a></td>
                                        <td><a href="" class="text-primary">Download dan Upload</a></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="col-2 ">
                            <div class="row">
                                <p></p>
                            </div>
                            <div class="row">
                                <p></p>
                            </div>
                            <div class="row">
                                <p></p>
                            </div>
                            <div class="row">
                                <p></p>
                            </div>
                            <div class="row">
                                <p></p>
                            </div>
                            <div class="row">
                                <p></p>
                            </div>
                            <div class="row"><a href="">
                                    <p class="fs-6">see More...</p>
                                </a></div>
                        </div>
                    </div>

                    <div
                        class="row d-flex justify-content-center  border-top border-primary border-2 mt-3 container-fluid shadow-6-strong ">
                        <div class="col">
                            <table class="table table-borderless mt-3 w-100  " style="background-color: #F5F4F4;">
                                <thead class="">
                                    <td class="col-3">Yayasan Kanisius:</td>
                                    <td class="col-2">Sekolah Dasar</td>
                                    <td class="">Sekolah Menengah Pertama</td>
                                </thead>
                                <tbody class=" mt-5">
                                    <tr>
                                        <th></th>
                                        <td>Sekolah Dasar</td>
                                        <td>Sekolah Menengah Pertama</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>Sekolah Dasar</td>
                                        <td>Sekolah Menengah Pertama</td>
                                    </tr>
                                    <tr class="">
                                        <th></th>
                                        <td>Sekolah Dasar</td>
                                        <td>Sekolah Menengah Pertama</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-2 ">
                            <div class="row mt-5"></div>
                            <div class="row mt-5"></div>
                            <div class="row mt-5"></div>
                            <div class="row mt-5"></div>
                            <div class="row mt-5"></div>
                            <div class="row"><a href="">
                                    <p class="fs-6">see More...</p>
                                </a></div>
                        </div>

                    </div>


                </div>

            </div>
            <!-- tabel -->
        </div>
        <!--Main Navigation-->

        <!--Main layout-->
        <main style="margin-top: 58px;">
            <div class="container pt-4"></div>
        </main>
        <!--Main layout-->

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
</body>

</html>