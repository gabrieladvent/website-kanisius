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
    <!-- link css -->
    <link rel="stylesheet" href="{{ asset('../css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('../css/styleHomeSekolah.css') }}" />
    <!-- link scss -->

</head>

<body style="background-color: #fcf2fc;">
    @include('navbar.navbar-main')
    <nav class="main-menu">
        <ul>
            <li>
                <a href="/dashboard" class="icon"><img src="{{ asset('/icon/house-solid.svg') }}" alt=""></a>
            </li>

            <li>
                <a href="{{ route('kiriman-data') }}" class="icon"><img src="{{ asset('/icon/database-solid.svg') }}"
                        alt=""></a>
            </li>
            <li>
                <a href="{{ route('dashboard.data') }}" class="icon"><img
                        src="{{ asset('/icon/user-group-solid.svg') }}" alt=""></a>
            </li>
            <li>
                <a href="{{ route('notifikasi') }}" class="icon"><img src="{{ asset('/icon/bell-solid.svg') }}"
                        alt=""></a>
            </li>
            <li>
                <a href="#laporan" class="icon"><img src="{{ asset('/icon/book-solid.svg') }}" alt=""></a>
            </li>
        </ul>

        <ul class="logout">
            <li>
                <a href="{{ route('profile-yayasan') }}" class="icon"><img src="{{ asset('/icon/user-tie-solid.svg') }}"
                        alt=""></a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="icon"><img src="{{ '/icon/sign-out-alt-solid.svg' }}"
                        alt=""></a>
            </li>
        </ul>
    </nav>

    <div>
        @yield('isi-content')
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
</body>
</html>
