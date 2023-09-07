@php
    use Carbon\Carbon;
@endphp

@extends('layout-sekolah.second')
@section('isi-content')
    @if (\Carbon\Carbon::now()->between(\Carbon\Carbon::parse($upload_start), \Carbon\Carbon::parse($upload_end)))
        <div class="data-siswa py-5 px-3" style="background: #221e6c;">
            <div class="card">
                <div class="card-header" style="background: #89a5dd; display: flex; align-items: center;">
                    <p class="px-1 h1 fw-bold">File Submissions
                        <a href="{{ route('template-excel') }}" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-exclamation-circle" style="font-size: 16px; color: aliceblue"
                                title="Download Template"></i>
                        </a>
                    </p>
                    <div class="col" style="margin-top: auto;">
                        <p class="float-end me-3">Maximum file size: 20 MB</p>
                    </div>
                </div>

                <div class="first-box px-4 ms-4">
                    <div class="row p-2" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
                        <div class="col">
                            <h1 class="h4 text-center ">Drag &amp; drop file upload</h1>
                            <form action="{{ route('upload', ['slug' => $user->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <fieldset class="upload_dropZone text-center mb-3 p-4">
                                    <legend class="visually-hidden">File uploader</legend>
                                    <i class="fa-solid fa-file-excel fa-2xl"></i>
                                    <p class="small my-2 mt-4">You can drag and drop files here to add them
                                        <br><i>or</i>
                                    </p>

                                    <!-- Perbarui ID menjadi 'upload_excel_first' -->
                                    <input id="upload_excel_first" name="file" class="position-absolute invisible"
                                        type="file" multiple
                                        accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />

                                    <label class="btn btn-upload mb-3" for="upload_excel_first">Choose file(s)</label>
                                    <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0">
                                    </div>
                                </fieldset>
                                <svg style="display:none">
                                    <defs>
                                        <symbol id="icon-imageUpload" clip-rule="evenodd" viewBox="0 0 96 96">
                                            <!-- ... (ikon tersedia di sini) -->
                                        </symbol>
                                    </defs>
                                </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ms-2">
                <div class="col ps-2">
                    <p class="text-white">Accepted file type: xlsx</p>
                </div>
            </div>
            <div class="second-box px-3 ms-4">
                <div class="p-3 px-3" style="background-color: rgb(242, 242, 242); box-shadow:4px 7px 10px rgba(0,0,0,.4);">
                    <div class="row ">
                        <div class="col">
                            <input type="text" class="w-100 pb-5 border border-dark container-fluid shadow-3-strong"
                                name="komentar" style="height: 100px;"
                                placeholder="Silahkan masukan komentar atau pesan (opsional)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-2">
                    <button type="submit" class="w-75 btn bg-success text-white" id="submit-button"
                        disabled>Submit</button>
                </div>
                <div class="col-2">
                    <a href="" class="w-75 text-white btn bg-danger">Cancel</a>
                </div>
            </div>
            </form>
        </div>
    @else
        <div class="data-siswa py-5 " style="background: #221e6c;">
            <div class="card">
                <div class="card-header" style="background: #89a5dd; display: flex; align-items: center;">
                    <p class="px-1 h1 fw-bold">File Submissions
                        <a href="{{ route('template-excel') }}" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-exclamation-circle" style="font-size: 16px;" title="Download Template"></i>
                        </a>
                    </p>
                </div>
                <div class="col ms-2">
                    <p class="ms-2 h5 text-danger" style="font-style: italic">! Portal Ditutup</p>
                    <p class="ms-2 mt-1 h5 text-black-50"> Silahkan Hubungi Admin Untuk Mengaktifkan Portal</p>
                </div>
            </div>
        </div>
    @endif
    </div>

    <!-- Letakkan script ini di bagian bawah HTML Anda -->
    <script>
        // Mendapatkan elemen dropzone pertama
        var dropZoneFirst = document.querySelector('.upload_dropZone');
        console.log('hal');

        // Menambahkan event listener untuk dragover agar mengubah tampilan saat file di-drag
        dropZoneFirst.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropZoneFirst.classList.add('dragover');
        });

        // Menambahkan event listener untuk dragleave agar mengembalikan tampilan saat file tidak di-drag
        dropZoneFirst.addEventListener('dragleave', function() {
            dropZoneFirst.classList.remove('dragover');
        });

        // Menambahkan event listener untuk drop agar menangani file yang di-drop
        dropZoneFirst.addEventListener('drop', function(e) {
            e.preventDefault();
            dropZoneFirst.classList.remove('dragover');

            // Mengambil file yang di-drop
            var files = e.dataTransfer.files;

            // Memeriksa apakah ada file yang di-drop
            if (files.length > 0) {
                // Memeriksa apakah file pertama adalah file Excel (xlsx)
                if (files[0].type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                    // Mengisi input file pertama dengan file yang di-drop
                    var fileInput = document.getElementById('upload_excel_first');
                    fileInput.files = files;

                    // Tambahkan kode untuk mengaktifkan tombol submit
                    enableSubmitButton();
                } else {
                    alert('File harus berformat Excel (xlsx)');
                    // Refresh halaman
                    window.location.reload();
                }
            } else {
                // Mencetak "File tidak ada" ke konsol
                console.log('File tidak ada');
            }
        });

        // Tambahkan event listener untuk input file (choosen file)
        var fileInput = document.getElementById('upload_excel_first');
        fileInput.addEventListener('change', function(e) {
            var files = e.target.files;

            // Memeriksa apakah ada file yang dipilih
            if (files.length > 0) {
                // Memeriksa apakah file pertama adalah file Excel (xlsx)
                if (files[0].type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                    // Tambahkan kode untuk mengaktifkan tombol submit
                    enableSubmitButton();
                } else {
                    alert('File harus berformat Excel (xlsx)');
                    // Reset input file
                    e.target.value = '';
                }
            }
        });

        // Fungsi untuk mengaktifkan tombol submit
        function enableSubmitButton() {
            var submitButton = document.getElementById('submit-button');
            submitButton.removeAttribute('disabled');
        }

        // Cek apakah ada file saat halaman dimuat
        window.addEventListener('load', function() {
            var fileInput = document.getElementById('upload_excel_first');
            if (fileInput.files.length > 0) {
                enableSubmitButton();
            }
        });
    </script>
@endsection
