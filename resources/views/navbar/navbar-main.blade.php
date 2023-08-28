<section>
    <nav class="navbar navbar-expand-lg navbar-light  fixed-top" style="background: #244076;">
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
                        <h5 class="inter text" style="color : #FFF000">
                            Selamat Datang, <strong>{{ $user->name }}</strong>
                        </h5>
                    </div>
                </div>
                <!-- Left links -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-nowrap">
                    <li class="nav-item">
                        <a class="inter nav-link active" style="color : #FFF000" aria-current="page" href="{{ route('tutorial') }}">Video Tutorial</a>
                    </li>
                    <li class="nav-item">
                        <a class="inter nav-link" style="color : #FFF000" href="{{ route('panduan-buku') }}" target="_blank">Dokumentasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="inter nav-link " style="color : #FFF000" href="mailto:yayasankanisiusbintaran@gmail.com?subject=Keluhan%20WEBSITE%20DATA%20SISWA%20&body=NAMA%20LENGKAP%20%3A%0D%0ANAMA%20SEKOLAH%20%3A%0D%0AISI%20KELUHAN%20%3A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A">Kontak Admin</a>
                    </li>
                    
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
</section>
