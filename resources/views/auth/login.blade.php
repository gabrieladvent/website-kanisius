<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

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
                            <img src="{{ asset('/image/HITAM.png') }}"
                                style="width: 15%; margin-left: 1%; margin-top: 1%">
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
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>

                                <div class="password-container">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password" id="password" autocomplete="current-password">
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
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
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
    <div class="svg-container">
      <svg id="visual" viewBox="0 0 900 600" width="900" height="643" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><path d="M654 0L617 14.7C580 29.3 506 58.7 478.2 87.8C450.3 117 468.7 146 470.2 175.2C471.7 204.3 456.3 233.7 477 262.8C497.7 292 554.3 321 581.8 350.2C609.3 379.3 607.7 408.7 566.8 437.8C526 467 446 496 432 525.2C418 554.3 470 583.7 509.7 612.8C549.3 642 576.7 671 590.3 685.5L604 700L0 700L0 685.5C0 671 0 642 0 612.8C0 583.7 0 554.3 0 525.2C0 496 0 467 0 437.8C0 408.7 0 379.3 0 350.2C0 321 0 292 0 262.8C0 233.7 0 204.3 0 175.2C0 146 0 117 0 87.8C0 58.7 0 29.3 0 14.7L0 0Z" fill="#c6cfdd"></path><path d="M312 0L316.8 14.7C321.7 29.3 331.3 58.7 341.5 87.8C351.7 117 362.3 146 374.2 175.2C386 204.3 399 233.7 387.7 262.8C376.3 292 340.7 321 355.5 350.2C370.3 379.3 435.7 408.7 455 437.8C474.3 467 447.7 496 451.3 525.2C455 554.3 489 583.7 495.2 612.8C501.3 642 479.7 671 468.8 685.5L458 700L0 700L0 685.5C0 671 0 642 0 612.8C0 583.7 0 554.3 0 525.2C0 496 0 467 0 437.8C0 408.7 0 379.3 0 350.2C0 321 0 292 0 262.8C0 233.7 0 204.3 0 175.2C0 146 0 117 0 87.8C0 58.7 0 29.3 0 14.7L0 0Z" fill="#8ea7d8"></path><path d="M310 0L311.7 14.7C313.3 29.3 316.7 58.7 314.8 87.8C313 117 306 146 306.2 175.2C306.3 204.3 313.7 233.7 325.2 262.8C336.7 292 352.3 321 346.2 350.2C340 379.3 312 408.7 317 437.8C322 467 360 496 375.5 525.2C391 554.3 384 583.7 354.3 612.8C324.7 642 272.3 671 246.2 685.5L220 700L0 700L0 685.5C0 671 0 642 0 612.8C0 583.7 0 554.3 0 525.2C0 496 0 467 0 437.8C0 408.7 0 379.3 0 350.2C0 321 0 292 0 262.8C0 233.7 0 204.3 0 175.2C0 146 0 117 0 87.8C0 58.7 0 29.3 0 14.7L0 0Z" fill="#5e7dcf"></path><path d="M256 0L260.5 14.7C265 29.3 274 58.7 269 87.8C264 117 245 146 229.5 175.2C214 204.3 202 233.7 189.3 262.8C176.7 292 163.3 321 177.3 350.2C191.3 379.3 232.7 408.7 252.5 437.8C272.3 467 270.7 496 252.5 525.2C234.3 554.3 199.7 583.7 207 612.8C214.3 642 263.7 671 288.3 685.5L313 700L0 700L0 685.5C0 671 0 642 0 612.8C0 583.7 0 554.3 0 525.2C0 496 0 467 0 437.8C0 408.7 0 379.3 0 350.2C0 321 0 292 0 262.8C0 233.7 0 204.3 0 175.2C0 146 0 117 0 87.8C0 58.7 0 29.3 0 14.7L0 0Z" fill="#3552c1"></path><path d="M196 0L185 14.7C174 29.3 152 58.7 140.8 87.8C129.7 117 129.3 146 132.5 175.2C135.7 204.3 142.3 233.7 136 262.8C129.7 292 110.3 321 111.8 350.2C113.3 379.3 135.7 408.7 146.5 437.8C157.3 467 156.7 496 150.3 525.2C144 554.3 132 583.7 130 612.8C128 642 136 671 140 685.5L144 700L0 700L0 685.5C0 671 0 642 0 612.8C0 583.7 0 554.3 0 525.2C0 496 0 467 0 437.8C0 408.7 0 379.3 0 350.2C0 321 0 292 0 262.8C0 233.7 0 204.3 0 175.2C0 146 0 117 0 87.8C0 58.7 0 29.3 0 14.7L0 0Z" fill="#1820ab"></path></svg>
    </div>
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
