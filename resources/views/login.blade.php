<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="../../public/css/loginCSS.css" />
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
                <img src="../../public/image/logo.png" style="width: 3%;">
                <img src="../../public/image/HITAM.png" style="width: 15%; margin-left: 1%; margin-top: 1%">
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
              <form>
                <div class="mb-3">
                  <!-- <label for="username" class="form-label ">Username</label> -->
                  <i class="fas fa-user"></i> Username
                  <input type="text" class="form-control fst-italic fw-light " id="username" placeholder="Enter your username....." />
                </div>
                <div class="mb-3">
                  <!-- <label for="password" class="form-label">Password</label> -->
                  <i class="fas fa-lock"></i> Password
                  <input type="password" class="form-control fst-italic fw-light " id="password" placeholder="Enter your password....." />
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg">Masuk</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <img src="../../public/image/tema.png" alt="Logo" width="800" class="d-inline-block mx-auto mt-4" />
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
