<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('/css/loginCSS.css') }}" />
</head>

<body>
    <section>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarRightAlignExample" aria-controls="navbarRightAlignExample"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarRightAlignExample">
                    <div class="row">
                        <div class="col-lg-12 mx-2">
                            <img src="{{ asset('/image/logo.png') }}" style="width: 3%;">
                            <img src="{{ asset('/image/logo-tengah-fix-.png') }}"
                                style="width: 15%; margin-left: 1%;">
                        </div>
                    </div>
                    <!-- Left links -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-nowrap">
                        <li class="nav-item">
                            <a class="inter nav-link active" aria-current="page" href="#">Video Tutorial</a>
                        </li>
                        <li class="nav-item">
                            <a class="inter nav-link text-dark" href="#">Dokumentasi</a>
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

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-dark h3 mb-3">LOGIN</h5>

                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input type="text" id="email" name="email"
                                    class="form-control  @error('email') is-invalid @enderror" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Nama pengguna atau kata sandi salah</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" id="password" autocomplete="current-password">
                                
                                    <div class="input-group-text password-toggle-container">
                                        <i class="fa fa-eye-slash" id="togglePassword"></i>
                                    </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <img src="{{ asset('storage/' . $poto->nama_foto) }}" alt="" style="width:500px;"
                    class="me-3 d-flex d-inline-block mx-auto mt-4" />
            </div>
        </div>
    </div>


    @if (Session::has('success'))
        <script>
            toastr.options = {
                "closeButton": true,
                positionClass: 'toast-top-right',
            }
            toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            toastr.options = {
                "closeButton": true,
                positionClass: 'toast-top-right',
            }
            toastr.error();
            ("{{ Session::get('error') }}");
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            if (type === 'password') {
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    </script>

</body>

</html>
