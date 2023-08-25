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
<<<<<<< HEAD
                        <a class="inter nav-link active" aria-current="page" href="{{ route('tutorial') }}">Video Tutorial</a>
                    </li>
                    <li class="nav-item">
                        <a class="inter nav-link text-dark" href="{{ route('panduan-buku') }}" target="_blank">Dokumentasi</a>
=======
                        <a class="inter nav-link active" style="color : #FFF000" aria-current="page" href="#">Video Tutorial</a>
                    </li>
                    <li class="nav-item">
                        <a class="inter nav-link" style="color : #FFF000" href="#" target="_blank">Dokumentasi</a>
>>>>>>> fb87913fd4f0b1342e58b780b1659fdc9930c961
                    </li>
                    <li class="nav-item">
                        <a class="inter nav-link " style="color : #FFF000" href="https://wa.me/6285820876251">Kontak Admin</a>
                    </li>
                    
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
</section>
