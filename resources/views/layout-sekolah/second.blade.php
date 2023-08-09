<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/image/logo.png') }}" rel="icon">
    <title>Sekolah | {{ $title }}</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/css/styleHomeSekolah.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    @push('js')
        <script src="{{ asset('js/js.js') }}"></script>
    @endpush
    @push('table')
        <script src="{{ asset('js/jsDataSiswaSekolah.js') }}"></script>
    @endpush
</head>

<body style="background-color: #fcf2fc;">
    @include('navbar.navbar-second')

    <!-- sidebar -->
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
                <a href="{{ route('logout') }}">
                    <img src="{{ asset('/icon/power-off-solid.svg') }}" alt="" class="fa fa-2x">
                    <span class="nav-text">Logout</span>
                </a>
            </li>
        </ul>
    </nav>


    <div>
        @yield('isi-content')
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    @stack('js')
    @stack('table')

    <script src="{{ asset('/js/jsDataSiswaSekolah.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/js.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/addons/datatables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
        console.clear();
        ('use strict');

        (function() {
            'use strict';

            const preventDefaults = event => {
                event.preventDefault();
                event.stopPropagation();
            };

            const highlight = event =>
                event.target.classList.add('highlight');

            const unhighlight = event =>
                event.target.classList.remove('highlight');

            const getInputAndGalleryRefs = element => {
                const zone = element.closest('.upload_dropZone') || false;
                const gallery = zone.querySelector('.upload_gallery') || false;
                const input = zone.querySelector('input[type="file"]') || false;
                return {
                    input: input,
                    gallery: gallery
                };
            }

            const handleDrop = event => {
                const dataRefs = getInputAndGalleryRefs(event.target);
                dataRefs.files = event.dataTransfer.files;
                handleFiles(dataRefs);
            }

            const eventHandlers = zone => {
                const dataRefs = getInputAndGalleryRefs(zone);
                if (!dataRefs.input) return;

                // Prevent default drag behaviors
                ;
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
                    zone.addEventListener(event, preventDefaults, false);
                    document.body.addEventListener(event, preventDefaults, false);
                });

                // Highlighting drop area when item is dragged over it
                ;
                ['dragenter', 'dragover'].forEach(event => {
                    zone.addEventListener(event, highlight, false);
                });;
                ['dragleave', 'drop'].forEach(event => {
                    zone.addEventListener(event, unhighlight, false);
                });

                // Handle dropped files
                zone.addEventListener('drop', handleDrop, false);

                // Handle browse selected files
                dataRefs.input.addEventListener('change', event => {
                    dataRefs.files = event.target.files;
                    handleFiles(dataRefs);
                }, false);
            }

            // Initialise ALL dropzones
            const dropZones = document.querySelectorAll('.upload_dropZone');
            for (const zone of dropZones) {
                eventHandlers(zone);
            }

            // Check if the file is an Excel file
            const isExcelFile = file => ['.xls', '.xlsx', '.csv'].includes(file.name.toLowerCase().substring(file.name
                .lastIndexOf('.')));

            // Check if the file size is within the limit
            const isFileSizeValid = file => file.size <= 20 * 1024 * 1024; // 20MB in bytes

            function previewFiles(dataRefs) {
                if (!dataRefs.gallery) return;
                for (const file of dataRefs.files) {
                    let reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onloadend = function() {
                        let img = document.createElement('img');
                        img.className = 'upload_image mt-2';
                        img.setAttribute('alt', file.name);
                        img.src = reader.result;
                        dataRefs.gallery.appendChild(img);
                    }
                }
            }

            // Upload the Excel file
            const excelUpload = dataRefs => {
                if (!dataRefs.files || !dataRefs.input) return;

                const url = dataRefs.input.getAttribute('data-post-url');
                if (!url) return;

                const name = dataRefs.input.getAttribute('data-post-name');
                if (!name) return;

                const formData = new FormData();
                for (const file of dataRefs.files) {
                    formData.append(name, file);
                }

                fetch(url, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('posted: ', data);
                        if (data.success === true) {
                            previewFiles(dataRefs);
                        } else {
                            console.log('URL: ', url, '  name: ', name)
                        }
                    })
                    .catch(error => {
                        console.error('errored: ', error);
                    });
            }

            const handleFiles = dataRefs => {
                let files = [...dataRefs.files];

                // Remove unaccepted file types or files exceeding the size limit
                files = files.filter(item => {
                    if (!isExcelFile(item)) {
                        console.log('Not an Excel file: ', item.type);
                    } else if (!isFileSizeValid(item)) {
                        console.log('File size exceeds the limit: ', item.size);
                    }
                    return isExcelFile(item) && isFileSizeValid(item) ? item : null;
                });

                if (!files.length) return;
                dataRefs.files = files;

                previewFiles(dataRefs);
                excelUpload(dataRefs);
            }
        })();

            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#exampleInputPassword1');
            const password2 = document.querySelector('#password-confirm');
        
            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute for password field
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon for password field
                if (type === 'password') {
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
        
                // toggle the type attribute for password2 field
                const type2 = password2.getAttribute('type') === 'password' ? 'text' : 'password';
                password2.setAttribute('type', type2);
                // toggle the eye slash icon for password2 field
                if (type2 === 'password') {
                    togglePassword2.classList.remove('fa-eye');
                    togglePassword2.classList.add('fa-eye-slash');
                } else {
                    togglePassword2.classList.remove('fa-eye-slash');
                    togglePassword2.classList.add('fa-eye');
                }
            });
    </script>

    @if (Session::has('success'))
        <script>
            toastr.options = {
                "closeButton": true,
                positionClass: 'toast-top-right',
            }
            toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
    @if (Session::has('gagal'))
        <script>
            toastr.options = {
                "closeButton": true,
                positionClass: 'toast-top-right',
            }
            toastr.error();
            ("{{ Session::get('gagal') }}");
        </script>
    @endif
</body>

</html>
