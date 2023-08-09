<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    {{-- <title>Yayasan | {{ $title }}</title> --}}

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

    <link rel="stylesheet" href="{{ asset('/css/styleHomeSekolah.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    @push('js')
        <script src="{{ asset('js/js.js') }}"></script>
    @endpush
    @push('table')
        <script src="{{ asset('js/jsDataSiswaSekolah.js') }}"></script>
    @endpush
</head>

<body style="background-color: #fcf2fc;">
    @include('navbar.navbar-second')
    <!-- sidebar -->
    <nav class="main-menu">
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

        <ul class="logout">
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

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#exampleInputPassword1');
            const password2 = document.querySelector('#password-confirm');
        
            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute for password field
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon for password field
                if (type === 'password') {
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
        
                // toggle the type attribute for password2 field
                const type2 = password2.getAttribute('type') === 'password' ? 'text' : 'password';
                password2.setAttribute('type', type2);
                // toggle the eye slash icon for password2 field
                if (type2 === 'password') {
                    togglePassword2.classList.remove('fa-eye');
                    togglePassword2.classList.add('fa-eye-slash');
                } else {
                    togglePassword2.classList.remove('fa-eye-slash');
                    togglePassword2.classList.add('fa-eye');
                }
            });
        </script>
        

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

    @stack('js')
    @stack('table')
</body>

</html>
