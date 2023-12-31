<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sekolah | Dashboard</title>
    <link href="{{ asset('/image/logo.png') }}" rel="icon">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ '/css/styleHomeSekolah.css' }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @keyframes moveText {
            0% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(10px);
                /* Atur pergeseran horizontal yang diinginkan */
            }

            100% {
                transform: translateX(0);
            }
        }

        #loader {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            /* Mengatur elemen-elemen menjadi tumpukan vertikal */
            justify-content: center;
            align-items: center;
            z-index: 999;
            position: fixed;
            background-color: rgba(255, 255, 255, 0.685);
        }

        #loader img {
            width: 150px;
        }

        #loader p {
            margin-top: 15px;
            /* Mengatur jarak atas antara gambar dan teks */
            animation: moveText 2s infinite;
        }
    </style>
</head>

<body style="background-color: #fcf2fc;">
    <div id="loader">
        <img src="{{ asset('/icon/loading2.gif') }}" alt="">
        <p class="h4">Mohon Tunggu...</p>
    </div>

    @include('navbar.navbar-main')

    <nav class="main-menu" style="margin-top: 4.5%">
        <ul>

            <li style="margin-bottom: 30px;">
                <a href="{{ route('sekolah', ['slug' => $user->slug]) }}">
                    <img src="{{ asset('/icon/house-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Dashboard</span>

                </a>
            </li>
            <li style="margin-bottom: 30px;" class="has-subnav">
                <a href="{{ route('upload-view', ['slug' => $user->slug]) }}">
                    <img src="{{ asset('/icon/paper-plane-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Kirim File</span>
                </a>
            </li>
            <li style="margin-bottom: 30px;" class="has-subnav">
                <a href="{{ route('data-siswa', ['slug' => $user->slug]) }}">
                    <img src="{{ asset('/icon/user-group-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Daftar Siswa-Siswi</span>
                </a>
            </li>
            <li style="margin-bottom: 30px;" class="has-subnav">
                <a href="{{ route('riwayat-kirim', ['slug' => $user->slug]) }}">
                    <img src="{{ asset('/icon/bell-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Notifikasi</span>
                </a>
            </li>
        </ul>

        <ul class="logout" style="bottom: 8.1%;">
            <li style="margin-bottom: 10px;">
                <a href="{{ route('profile') }}">
                    <img src="{{ asset('/icon/user-tie-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li>
                <a href="#logout" onclick="confirmLogout()">
                    <img src="{{ asset('/icon/power-off-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Logout</span>
                </a>

                <script>
                    function confirmLogout() {
                        if (confirm('Anda yakin ingin logout?')) {
                            window.location.href = "{{ route('logout') }}";
                        }
                    }
                </script>
            </li>
        </ul>
    </nav>

    <div>
        @yield('isi-content')
    </div>
    @include('navbar.footer')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('/js/jsDataSiswaSekolah.js') }}"></script>

    @if (Session::has('success'))
        <script>
            toastr.options = {
                "closeButton": true,
                positionClass: 'toast-top-right',
            }
            toastr.success("{{ Session::get('success') }}").addClass('toast-success');
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            toastr.options = {
                "closeButton": true,
                positionClass: 'toast-top-right',
            }
            toastr.error("{{ Session::get('error') }}").addClass('toast-error');
        </script>
    @endif
    <script>
        $(window).on('load', () => {
            $('#loader').slideUp(500, () => {
                $(this).hide();
            });
        });
    </script>
</body>

</html>
