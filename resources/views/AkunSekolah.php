<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.cdnfonts.com/css/ibarra-real-nova-2" rel="stylesheet">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />

    <!-- link css -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/mdb.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/addons/datatables.min.css">


</head>

<body>
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
                                <img src="img/logo-status.png" class="w-75" alt="Kanisius Logo" loading="lazy" />
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
                    <h3 class="fw-bold nofa">Username Dan Password</h3>
                </div>
                <div class="row-5 mt-5 mb-5 float-end ">
                    <button type="button" class="btn btn-primary me-5 fs-6">Tambah akun </button>
                </div>
                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Usernameame
                            </th>
                            <th class="th-sm">Password
                            </th>
                            <th class="th-sm">Edit
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>OPSD.sangken</td>
                            <td>194567</td>
                            <td><button type="button" class="btn btn-success me-5">Edit</button>
                                <button type="button" class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>OPPaud.sangken</td>
                            <td>194567</td>
                            <td><button type="button" class="btn btn-success me-5">Edit</button>
                                <button type="button" class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>OPSD.wates</td>
                            <td>194567</td>
                            <td><button type="button" class="btn btn-success me-5">Edit</button>
                                <button type="button" class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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