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
                        <h5 class="inter text" style="">
                            Selamat Datang, <strong>{{ $user->name }}</strong>
                        </h5>
                    </div>
                </div>
                <!-- Left links -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-nowrap">
                    <li class="nav-item">
                        <a class="inter nav-link active" aria-current="page" href="#">Video Tutorial</a>
                    </li>
                    <li class="nav-item">
                        <a class="inter nav-link text-dark" href="#" target="_blank">Dokumentasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="inter nav-link text-dark" href="#">Kontak Admin</a>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
</section>
