@if (\Auth::user()->status === 'yayasan')
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
                <a href="{{ route('laporan-data') }}">
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
          
        </ul>
    </nav>
@else
    <nav class="main-menu">
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

        <ul class="logout">
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
@endif
