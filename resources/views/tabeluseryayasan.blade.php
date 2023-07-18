<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
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


</head>

<body style="background-color: #fcf2fc;">
    <!--Main Navigation-->

    <section>
        <div class="row">
            <div class="col-1 mt-5">

                <!--Main Navigation-->
                <header>
                    <!-- Sidebar -->
                    <nav id="sidebarMenu" style="width: 100px !important;"
                        class="collapse d-lg-block sidebar collapse bg-white">
                        <div class="position-sticky d-flex justify-content-center ">
                            <div class="list-group list-group-flush mx-3 mt-4">
                                <a href="/dashboard" class=" list-group-item-action py-2 ripple" aria-current="true">
                                    <i class="fas fa-solid-alt fa-house fa-lg me-3"></i>
                                </a>
                                <a href="#" class=" list-group-item-action py-2 ripple ">
                                    <i class="fas fa-solid fa-table fa-lg me-3"></i>
                                </a>
                                <a href="#" class=" list-group-item-action py-2 ripple"><i
                                        class="fas fa-solid fa-users fa-lg me-3"></i><span></span></a>
                                <a href="#" class=" list-group-item-action py-2 ripple"><i
                                        class="fas fa-solid fa-bell fa-lg me-3"></i><span></span></a>
                                <a href="#" class=" list-group-item-action py-2 ripple">
                                    <i class="fas mb-14 fa-solid fa-book fa-lg me-3"></i><span></span>
                                </a>
                                <a href="#" class=" list-group-item-action py-2 ripple"><i
                                        class="fas  fa-solid fa-user fa-lg me-3"></i><span></span></a>
                                <a href="#" class=" list-group-item-action py-2 ripple"><i
                                        class="fas fa-solid fa-gear fa-lg me-3"></i><span></span></a>

                            </div>
                        </div>
                    </nav>
                    <!-- Sidebar -->

                    <!-- Navbar -->
                    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
                        <!-- Container wrapper -->
                        <div class="container-fluid">
                            <!-- Toggle button -->
                            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                                data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <i class="fas fa-bars"></i>
                            </button>

                            <!-- Brand -->
                            <a class="navbar-brand" href="#">
                                <img src="{{ asset('image/logo-status.png') }}" class="w-75" alt="Kanisius Logo" loading="lazy" />
                            </a>



                            <!-- Right links -->
                            <ul class="navbar-nav ms-auto d-flex flex-row ">
                                <!-- Notification dropdown -->
                                <li class="nav-item dropdown px-3">
                                    <a href="" class="text-dark">Video Tutorial</a>
                                </li>

                                <!-- Icon -->
                                <li class="nav-item px-3">
                                    <a class="text-dark" href="#">
                                        Dokumentasi
                                    </a>
                                </li>
                                <!-- Icon -->
                                <li class="nav-item">
                                    <a class="text-dark" href="#">
                                        Kontak Admin
                                    </a>
                                </li>




                            </ul>
                        </div>
                        <!-- Container wrapper -->
                    </nav>
                    <!-- Navbar -->
                </header>
                <!--Main Navigation-->

                <!--Main layout-->
                <main style="margin-top: 58px;">
                    <div class="container pt-4"></div>
                </main>
                <!--Main layout-->
            </div>
            <div class="col mt-5 py-5 px-5 container-fluid shadow-6-strong">
                <div class="mt-3 text-center ">
                    <h3 class="fw-bold nofa">Data Siswa - Siswi<br>
                        Tahun ajaran 2023/2024</h3>
                </div>
                <div class="row mt-5">
                    <div class="col-1">
                        <div class="dropdown  ">
                            <button class="btn bg-dark text-white dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                                Bulan
                            </button>
                            <ul class="dropdown-menu bg-dark " aria-labelledby="dropdownMenuButton">
                                <li><span class="dropdown-item text-white">Januari</span></li>
                                <li><span class="dropdown-item text-white">Febuari</span></li>
                                <li><span class="dropdown-item text-white">Maret</span></li>
                                <li><span class="dropdown-item text-white">April</span></li>
                                <li><span class="dropdown-item text-white">Mei</span></li>
                                <li><span class="dropdown-item text-white">Juni</span></li>
                                <li><span class="dropdown-item text-white">Juli</span></li>
                                <li><span class="dropdown-item text-white">Agustus</span></li>
                                <li><span class="dropdown-item text-white">September</span></li>
                                <li><span class="dropdown-item text-white">Oktober</span></li>
                                <li><span class="dropdown-item text-white">November</span></li>
                                <li><span class="dropdown-item text-white">Desember</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="dropdown ms-5">
                            <button class="btn bg-dark text-white dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                                Tahun
                            </button>
                            <ul class="dropdown-menu bg-dark hover-overlay" aria-labelledby="dropdownMenuButton">
                                <li><span class="dropdown-item text-white">2020</span></li>
                                <li><span class="dropdown-item text-white">2021</span></li>
                                <li><span class="dropdown-item text-white">2022</span></li>
                                <li><span class="dropdown-item text-white">2023</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">NISN</th>
                            <th class="th-sm">Nama Siswa</th>
                            <th class="th-sm">Tanggal Lahir</th>
                            <th class="th-sm">Jenis Kelamin</th>
                            <th class="th-sm">Kelas</th>
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
                </table>
                {{ $data_siswa->links() }}
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