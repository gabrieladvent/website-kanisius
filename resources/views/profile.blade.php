<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.cdnfonts.com/css/ibarra-real-nova-2" rel="stylesheet">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />

    <!-- link css -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/addons/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/styleHomeSekolah.css') }}"/>
</head>

<body style="background-image: url('{{ asset('/image/bg.png') }}');">
                <!--Main Navigation-->
                <header>
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
                                        <h5 class="inter text">
                                            Selamat Datang, <strong>{{ $user->name }}</strong>
                                        </h5>
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
                                  <a href="#logout" class="icon"><img src="{{ ('/icon/sign-out-alt-solid.svg') }}" alt=""></a>
                               </li>  
                            </ul>
                        </nav>
                </header>
                <!--Main Navigation-->

                <!--Main layout-->
            </div>
            <div class=" mt-5 py-4 px-5 container-fluid">
                <div class="row mt-5 d-flex justify-content-center">
                    <div class="col-3 text-center">
                        <img src="{{ asset('/icon/user-tie-solid.svg') }}" width="100px" alt="">
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-3 mt-3 text-center">
                            <p class="fw-bold">{{ $user->id .' '. $user->name }} </p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-3 mt-3 text-center">
                            <a href="" class="btn bg-light w-50 ">Edit Tema</a>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-3 mt-3 text-center">
                            <a href="" class="btn bg-light w-50 ">Req Tema</a>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-3 mt-3 mb-12 text-center">
                            <a href="akun-yayasan" class="btn bg-light w-50 ">AKun Yayasan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--Main layout-->
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script type="text/javascript" src="{{ asset('/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/addons/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/js.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });

    </script>
</body>

</html>