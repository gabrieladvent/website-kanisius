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

    <link rel="stylesheet" href="{{ '/css/styleHomeSekolah.css' }}" />
</head>

<body style="background-color: #fcf2fc;">
    @include('navbar.navbar-main')

    <nav class="main-menu">
        <ul>
            <li>
                <a href="{{ route('sekolah', ['nomor_s' => $user->id]) }}" class="icon"><img src="{{ asset('/icon/house-solid.svg') }}"
                        alt=""></a>
            </li>
            <li>
                <a href="{{ route('upload-view',['nomor_s' =>$user->id]) }}" class="icon"><img src="{{ asset('/icon/paper-plane-solid.svg') }}"
                        alt=""></a>
            </li>
            <li>
                <a href="{{ route('data-siswa', ['nomor_s' => $user->id]) }}" class="icon">
                    <img src="{{ asset('/icon/user-group-solid.svg') }}" alt="">
                </a>
            </li>
            <li>
                <a href="{{ route('notifikasi') }}" class="icon"><img src="{{ asset('/icon/bell-solid.svg') }}" alt=""></a>
            </li>
        </ul>

        <ul class="logout">
            <li>
                <a href="{{ route('profile') }}" class="icon"><img src="{{ asset('/icon/user-tie-solid.svg') }}" alt=""></a>

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

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ asset('/js/jsDataSiswaSekolah.js') }}"></script>
</body>

</html>
