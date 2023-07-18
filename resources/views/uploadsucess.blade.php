<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sukses</title>
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.cdnfonts.com/css/ibarra-real-nova-2" rel="stylesheet">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />

    <!-- link css -->
    <link rel="stylesheet" href="{{ '/css/styleHomeSekolah.css' }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/addons/datatables.min.css') }}">
</head>

<body style="background-color: #fcf2fc;">
    <!--Main Navigation-->
    <div class="row badan">
        <div class="col-1" style="margin-left: -2%;">
            <!--Main Navigation-->
            <header>
                <!-- Sidebar -->
                <nav class="main-menu">
                    <ul>
                        <li>
                            <a href="/sekolah/2032" class="icon"><img src="{{ asset('/icon/house-solid.svg') }}"
                                    alt=""></a>
                        </li>
                        <li>
                            <a href="/sekolah/2032/upload" class="icon"><img
                                    src="{{ asset('/icon/paper-plane-solid.svg') }}" alt=""></a>
                        </li>
                        <li>
                            <a href="/sekolah/data/2032" class="icon"><img
                                    src="{{ asset('/icon/user-group-solid.svg') }}" alt=""></a>
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
                <!-- Sidebar -->

                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                            data-mdb-target="#navbarRightAlignExample" aria-controls="navbarRightAlignExample"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>

                        <!-- Collapsible wrapper -->
                        <div class="collapse navbar-collapse" id="navbarRightAlignExample">
                            <div class="row">
                                <div class="col-lg-12">
                                    <img src="{{ asset('/image/logo.png') }}" style="width: 3%;">
                                    <img src="{{ asset('/image/HITAM.png') }}"
                                        style="width: 15%; margin-left: 1%; margin-top: 1%">
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
                <!-- Navbar -->
            </header>
            <!--Main Navigation-->

            <!--Main layout-->
            <main style="margin-top: 2%;">
                <div class="container pt-4"></div>
            </main>
            <!--Main layout-->
        </div>
        <div class="col mt-5 px-5 container-fluid shadow-6-strong">
            <div class="row">
                <p class="text-dark mt-5 h2 fw-bold">Submission Status</p>
            </div>
            <div class="item-bar" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
                <div class="row mt-5">
                    <div class="col-2 mt-3 ms-2">
                        <p class="text-dark h5 mt-2">Submission Status</p>
                    </div>
                    <div class="col py-2 items" style="background-color: #CEEECE;">
                        <p class="h4 fw-bold mt-1" style="letter-spacing: 3px">Submitted</p>
                    </div>
                </div>
            </div>

            <div class="item-bar" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
                <div class="row mt-5">
                    <div class="col-2 mt-3 ms-2">
                        <p class="text-dark h5 mt-2">Last Modified</p>
                    </div>
                    <div class="col py-2">
                        <p class="h5 mt-2">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="item-bar" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
                <div class="row mt-5">
                    <div class="col-2 mt-3 ms-2">
                        <p class="text-dark h5 mt-2">File Submissions</p>
                    </div>
                    <div class="col py-2">
                        <p class="h5 mt-2"><i class="fa-solid fa-file-excel fa-xl me-3"></i>{{ session('filename') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="item-bar" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
                <div class="row mt-5">
                    <div class="col-2 mt-2 ms-2">
                        <p class="text-dark h5 mt-2">Comments Submissions</p>
                    </div>
                    <div class="col py-2">
                        @if (session('komentar') !== '')
                            <p class="h5 mt-2"><i class="fa-xl me-2"></i>{{ session('komentar') }}</p>
                        @else
                            <p class="h5 mt-2"><i class="fa-xl me-2"></i>Tidak Ada komentar</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <div class="row mt-5 mb-5 d-flex justify-content-center">
                    <div class="col-2 mb-5">
                        <a href="/sekolah/2032/upload?edit=true" class="btn bg-dark text-white mb-5">Edit Submission</a>
                    </div>
                    <div class="col-3">
                        <form action="{{ url('remove') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn bg-light border-1 text-dark">Remove Submission</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php session()->forget('upload_sukses'); ?>
    <!--Main layout-->
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script type="text/javascript" src="{{ asset('/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/addons/datatables.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>

</html>
