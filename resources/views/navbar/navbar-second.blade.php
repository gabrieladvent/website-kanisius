<section>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarRightAlignExample" aria-controls="navbarRightAlignExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarRightAlignExample">
                <div class="row">
                    <div class="col-lg-12 ms-5">
                        <img src="{{ asset('/image/logo.png') }}" style="width: 3%;">
                        <img src="{{ asset('/image/logo-tengah-fix-.png') }}" style="width: 15%; margin-left: 1%;">
                    </div>
                </div>
                <!-- Left links -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-nowrap">
                    <li class="nav-item">
                        <a class="inter nav-link active" aria-current="page" href="{{ route('tutorial') }}">Video Tutorial</a>
                    </li>
                    <li class="nav-item">
                        <a class="inter nav-link text-dark" href="{{ route('panduan-buku') }}">Dokumentasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="inter nav-link text-dark" href="mailto:yayasankanisiusbintaran@gmail.com?subject=Keluhan%20WEBSITE%20DATA%20SISWA%20&body=NAMA%20LENGKAP%20%3A%0D%0ANAMA%20SEKOLAH%20%3A%0D%0AISI%20KELUHAN%20%3A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A">Kontak Admin</a>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
</section>
