@extends('layout-sekolah.second')
@section('isi-content')
    <div class="data-siswa py-5 " style="background: #244076;">
        <div class="card">
            <div class="card-header" style="background: #89a5dd; display: flex; align-items: center;">
                <p class="text-dark h2 fw-bold">Submission Status</p>
            </div>
            <div class="tengah px-2">
                <div class="sub-tengah px-5">

                    <div class="item-bar" style="background-color: white;">
                        <div class="row ">
                            <div class="col-2 mt-3 ms-2">
                                <p class="text-dark h5 mt-2">Submission Status</p>
                            </div>
                            <div class="col py-2">
                                <p class="h5 fw-bold mt-2 custom-text" style="background-color: #46c476">Berhasil</p>
                            </div>
                        </div>
                    </div>

                    <div class="item-bar" style="background-color: white;">
                        <div class="row ">
                            <div class="col-2 mt-3 ms-2">
                                <p class="text-dark h5 mt-2">Last Modified</p>
                            </div>
                            <div class="col py-2">
                                <p class="h5 mt-2">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="item-bar" style="background-color: white;">
                        <div class="row ">
                            <div class="col-2 mt-3 ms-2">
                                <p class="text-dark h5 mt-2">File Submissions</p>
                            </div>
                            <div class="col py-2">
                                @if (session('filename'))
                                    <p class="h5 mt-1"><i
                                            class="fa-solid fa-file-excel fa-xl me-3"></i>{{ session('filename') }}</p>
                                @else
                                    <p class="h5 mt-1"><i
                                            class="fa-solid fa-file-excel fa-xl me-3"></i>{{ $kirim->nama_file }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="item-bar" style="background-color: white;">
                        <div class="row ">
                            <div class="col-2 mt-2 ms-2">
                                <p class="text-dark h5 mt-2">Comments Submissions</p>
                            </div>
                            <div class="col py-2">
                                @if (session('komentar'))
                                    <p class="h5 mt-1"><i class="fa-xl me-2"></i>{{ session('komentar') }}</p>
                                @else
                                    <p class="h5 mt-1"><i class="fa-xl me-2"></i>{{ $kirim->Komentar }}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-1 ms-2">
                <div class="row mt-5 mb-3 ms-5 d-flex justify-content-center">
                    <div class="col-3">
                        <form
                            action="{{ route('hapus-file', ['id' => session('filename') ? session('filename') : $kirim->nama_file]) }}"
                            method="POST" id="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn bg-danger border-1 text-dark" onclick="confirmDelete()">Remove
                                Submission</button>
                        </form>

                        <script>
                            function confirmDelete() {
                                if (confirm('Anda yakin ingin menghapus data ini?')) {
                                    document.getElementById('delete-form').submit();
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
