<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.cdnfonts.com/css/ibarra-real-nova-2" rel="stylesheet">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />

    <!-- link css -->
    <link rel="stylesheet" href="{{ '/css/styleHomeSekolah.css' }}"/>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/addons/datatables.min.css') }}">


</head>

<body style="background-color: #fcf2fc;">
    {{-- @include('sweetalert::alert') --}}
    <!--Main Navigation-->

        <div class="row">
            <div class="col-1" style="margin-left: -2%">

                <!--Main Navigation-->
                <header>
                    <!-- Sidebar -->
                    <nav class="main-menu">
                        <ul>
                            <li>
                                <a href="/sekolah/2032" class="icon"><img src="{{ asset('/icon/house-solid.svg') }}" alt=""></a>
                            </li>
                            <li>
                              <a href="/sekolah/2032/upload" class="icon"><img src="{{ asset('/icon/paper-plane-solid.svg') }}" alt=""></a>
                            </li>
                            <li>
                              <a href="/sekolah/data/2032" class="icon">
                                <img src="{{ asset('/icon/user-group-solid.svg') }}" alt="">
                              </a>
                            </li>
                            <li>
                              <a href="#" class="icon"><img src="{{ asset('/icon/bell-solid.svg') }}" alt=""></a>
                            </li>
                        </ul>
            
                        <ul class="logout">
                            <li>
                              <a href="#" class="icon"><img src="{{ asset('/icon/user-tie-solid.svg') }}" alt=""></a>
                            </li> 
                            <li>
                              <a href="#" class="icon"><img src="{{ ('/icon/gear-solid.svg') }}" alt=""></a>
                           </li>  
                        </ul>
                    </nav>
                    <!-- Sidebar -->

                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
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
                              <div class="col-lg-12 ms-5">
                                <img src="{{ asset('/image/logo.png') }}" style="width: 3%;">
                                <img src="{{ asset('/image/HITAM.png') }}" style="width: 15%; margin-left: 1%; margin-top: 1%">
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
                    <!-- Navbar -->
                </header>
                <!--Main Navigation-->

                <!--Main layout-->
                <main style="margin-top: 58px;">
                    <div class="container pt-4"></div>
                </main>
                <!--Main layout-->
            </div>
            <div class="col px-5 container-fluid shadow-6-strong ">
                <div class="row">
                    <div class="col fw-bold mt-5 px-5">
                        <p class="px-3 h2 mt-4 fw-bold">File Submissions</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="float-end me-3">Maximum file size: 20 MB</p>
                    </div>
                </div>
                <div class="row p-2" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
                    <div class="col">
                        <h1 class="h4 text-center ">Drag &amp; drop file upload</h1>
                        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <fieldset class="upload_dropZone text-center mb-3 p-4">
                                <legend class="visually-hidden">Image uploader</legend>
                                <i class="fa-solid fa-file-excel fa-2xl"></i>

                                <p class="small my-2 mt-4">You can drag and drop files here to add them <br><i>or</i>
                                </p>

                                <input id="upload_image_background" name="file" data-post-name="image_background"
                                    data-post-url="https://someplace.com/image/uploads/backgrounds/"
                                    class="position-absolute invisible" type="file" multiple
                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />

                                <label class="btn btn-upload mb-3" for="upload_image_background">Choose file(s)</label>
                                <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0"></div>
                            </fieldset>
                        <svg style="display:none">
                            <defs>
                                <symbol id="icon-imageUpload" clip-rule="evenodd" viewBox="0 0 96 96">
                                    <path
                                        d="M47 6a21 21 0 0 0-12.3 3.8c-2.7 2.1-4.4 5-4.7 7.1-5.8 1.2-10.3 5.6-10.3 10.6 0 6 5.8 11 13 11h12.6V22.7l-7.1 6.8c-.4.3-.9.5-1.4.5-1 0-2-.8-2-1.7 0-.4.3-.9.6-1.2l10.3-8.8c.3-.4.8-.6 1.3-.6.6 0 1 .2 1.4.6l10.2 8.8c.4.3.6.8.6 1.2 0 1-.9 1.7-2 1.7-.5 0-1-.2-1.3-.5l-7.2-6.8v15.6h14.4c6.1 0 11.2-4.1 11.2-9.4 0-5-4-8.8-9.5-9.4C63.8 11.8 56 5.8 47 6Zm-1.7 42.7V38.4h3.4v10.3c0 .8-.7 1.5-1.7 1.5s-1.7-.7-1.7-1.5Z M27 49c-4 0-7 2-7 6v29c0 3 3 6 6 6h42c3 0 6-3 6-6V55c0-4-3-6-7-6H28Zm41 3c1 0 3 1 3 3v19l-13-6a2 2 0 0 0-2 0L44 79l-10-5a2 2 0 0 0-2 0l-9 7V55c0-2 2-3 4-3h41Z M40 62c0 2-2 4-5 4s-5-2-5-4 2-4 5-4 5 2 5 4Z" />
                                </symbol>
                            </defs>
                        </svg>
                    </div>
                </div>
                <div class="row">
                    <div class="col ps-2">
                        <p class="">Accepted file type: xlsx, xls, csv</p>
                    </div>
                </div>
                <div class="p-3" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
                <div class="row ">
                    <div class="col">
                        <input type="text" class="w-100 pb-5 border border-dark container-fluid shadow-3-strong" name="komentar"
                            style="height: 150px;" placeholder="Silahkan masukan komentar atau pesan...">
                    </div>
                </div>
                </div>
                <div class="row mt-3 pb-2 d-flex justify-content-center">
                    <div class="col-2">
                        <button type="submit" class="w-75 btn bg-dark text-white">Submit</button>
                    </div>
                    <div class="col-2">
                        <a href="" class="w-75 text-dark btn bg-light">Cancel</a>
                    </div>
                </div>
            </form>
            {{-- @if (session::has('Sukses'))
                <script>
                    // swal("Berhasil!", "{{ session('success') }}", "success");
                    swal({
                            title: "Berhasil!",
                            text: "{{ session('sukses') }}",
                            icon: "success",
                            button: "Oke",
                            });
                </script>
            @endif

            @if (session('error'))
                <script>
                    swal("Error!", "{{ session('error') }}", "error");
                </script>
            @endif --}}
            </div>
        </div>
    {{-- </section> --}}
    <!--Main layout-->
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script type="text/javascript" src="{{ asset('/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/addons/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/js.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });

        // add code js
            const dropZone = document.querySelector('.upload_dropZone');
            const fileInput = document.querySelector('#upload_image_background');

            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('dragover');
            });

            dropZone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                dropZone.classList.remove('dragover');
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('dragover');
                const files = e.dataTransfer.files;
                fileInput.files = files;
            });

    </script>
</body>

</html>