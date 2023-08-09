<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yayasan | {{ $title }}</title>
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- link css -->
    <link rel="stylesheet" href="{{ asset('../css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('../css/styleHomeSekolah.css') }}" />
    <!-- link scss -->

</head>

<body style="background-color: #fcf2fc;">
    @include('navbar.navbar-main')
    <nav class="main-menu" style="margin-top: 4.5%">
        <ul>
            <li style="margin-bottom: 30px;">
                <a href="/dashboard">
                    <img src="{{ asset('/icon/house-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li style="margin-bottom: 30px;" class="has-subnav">
                <a href="{{ route('kiriman-data') }}">
                    <img src="{{ asset('/icon/database-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Update Database</span>
                </a>
            </li>
            <li style="margin-bottom: 30px;" class="has-subnav">
                <a href="{{ route('dashboard.data') }}">
                    <img src="{{ asset('/icon/user-group-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Daftar Siswa-Siswi</span>
                </a>
            </li>
            <li style="margin-bottom: 30px;" class="has-subnav">
                <a href="{{ route('notifikasi') }}">
                    <img src="{{ asset('/icon/bell-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Notifikasi</span>
                </a>
            </li>
            <li style="margin-bottom: 30px;" class="has-subnav">
                <a href="#Laporan">
                    <img src="{{ asset('/icon/book-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Laporan</span>
                </a>
            </li>
        </ul>

        <ul class="logout" style="bottom: 8.1%">
            <li style="margin-bottom: 10px;">
                <a href="{{ route('profile') }}">
                    <img src="{{ asset('/icon/user-tie-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}">
                    <img src="{{ asset('/icon/power-off-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <div>
        @yield('isi-content')
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (Session::has('success'))
        <script>
            toastr.options = {
                "closeButton": true,
                positionClass: 'toast-top-right',
            }
            toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
    @if (Session::has('gagal'))
        <script>
            toastr.options = {
                "closeButton": true,
                positionClass: 'toast-top-right',
            }
            toastr.error();
            ("{{ Session::get('gagal') }}");
        </script>
    @endif
</body>

</html>
