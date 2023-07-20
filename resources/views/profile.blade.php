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
</head>

<body>
    <!--Main Navigation-->

    <section style="background-image: url('{{ asset('/image/bg.png') }}');">
        <div class="row ">
            <div class="col-1 mt-5">

                <!--Main Navigation-->
                <header>
                    <!-- Sidebar -->
                    <nav id="sidebarMenu" style="width: 100px !important;"
                        class="collapse d-lg-block sidebar collapse bg-white">
                        <div class="position-sticky d-flex justify-content-center ">
                            <div class="list-group list-group-flush mx-3 mt-4">
                                <a href="#" class=" list-group-item-action py-2 ripple" aria-current="true">
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
            <div class="col mt-5 py-4 px-5 container-fluid shadow-6-strong  ">
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
    </section>
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