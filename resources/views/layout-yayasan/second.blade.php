<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    {{-- <title>Yayasan | {{ $title }}</title> --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('/css/styleHomeSekolah.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    
    @push('js')
        <script src="{{ asset('js/js.js') }}"></script>
    @endpush
    @push('laporan')
        <script src="{{ asset('js/laporan.js') }}"></script>
    @endpush
    @push('table')
        <script src="{{ asset('js/jsDataSiswaSekolah.js') }}"></script>
    @endpush
</head>

<body style="background-color: #244076">
    @include('navbar.navbar-second')
    <!-- sidebar -->
    @include('navbar.sidebar')

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

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#exampleInputPassword1');
        const password2 = document.querySelector('#password-confirm');

        togglePassword.addEventListener('click', function(e) {
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

    @stack('js')
    @stack('table')
    @stack('laporan')
    

</body>

</html>
