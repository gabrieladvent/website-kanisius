{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('/css/loginCSS.css') }}" />
  </head>
  <body>
    <section>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarRightAlignExample"
            aria-controls="navbarRightAlignExample"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars"></i>
          </button>
    
          <!-- Collapsible wrapper -->
          <div class="collapse navbar-collapse" id="navbarRightAlignExample">
            <div class="row">
              <div class="col-lg-12 mx-2">
                <img src="{{ asset('/image/logo.png')}}" style="width: 3%;">
                <img src="{{ asset('/image/HITAM.png')}}" style="width: 15%; margin-left: 1%; margin-top: 1%">
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

              <form method="POST" action="{{ route('login') }}">
                    @csrf
                <div class="input-group mb-3">
                  <input type="text" id="email" name="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email">
                  {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" id="password">
                  {{-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> --}}

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                @error('password')
                      <small>{{ $message }}</small>
                  @enderror
                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                      <input type="checkbox" id="remember">
                      <label for="remember">
                        Remember Me
                      </label>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>

            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <img src="{{ asset('/image/tema.png')}}" alt="Logo" width="800" class="d-inline-block mx-auto mt-4" />
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

