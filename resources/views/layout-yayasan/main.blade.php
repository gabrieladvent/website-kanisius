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
    <link rel="stylesheet" href="{{ asset('/css/dasboard.css') }}" />
    <!-- link scss -->
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
    <!-- sidebar -->
    @include('navbar.sidebar')

    <div>
        @yield('isi-content')
    </div>
    @include('navbar.footer')

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
