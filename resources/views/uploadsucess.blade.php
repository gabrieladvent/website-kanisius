@extends('layout-sekolah.second')
@section('isi-content')
    <div class="row ms-5 px-5 mt-5">
        <p class="text-dark mt-5 h2 fw-bold">Submission Status</p>
    </div>
    <div class="tengah px-5">
        <div class="sub-tengah px-5">
            <div class="item-bar" style="background-color: white;">
                <div class="row mt-3">
                    <div class="col-2 mt-3 ms-2">
                        <p class="text-dark h5 mt-2">Submission Status</p>
                    </div>
                    <div class="col py-2 items" style="background-color: #CEEECE;">
                        <p class="h4 fw-bold mt-1" style="letter-spacing: 3px">{{ session('id_kirim') }}</p>
                    </div>
                </div>
            </div>

            <div class="item-bar" style="background-color: white;">
                <div class="row mt-4">
                    <div class="col-2 mt-3 ms-2">
                        <p class="text-dark h5 mt-2">Last Modified</p>
                    </div>
                    <div class="col py-2">
                        <p class="h5 mt-2">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="item-bar" style="background-color: white;">
                <div class="row mt-4">
                    <div class="col-2 mt-3 ms-2">
                        <p class="text-dark h5 mt-2">File Submissions</p>
                    </div>
                    <div class="col py-2">
                        <p class="h5 mt-2"><i class="fa-solid fa-file-excel fa-xl me-3"></i>{{ session('filename') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="item-bar" style="background-color: white;">
                <div class="row mt-4">
                    <div class="col-2 mt-2 ms-2">
                        <p class="text-dark h5 mt-2">Comments Submissions</p>
                    </div>
                    <div class="col py-2">
                        <p class="h5 mt-1"><i class="fa-xl me-2"></i>{{ session('komentar') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 ms-5">
        <div class="row mt-5 mb-5 ms-5 d-flex justify-content-center">
            <div class="col-2 mb-5">
                <a href="/sekolah/2032/upload?edit=true" class="btn bg-dark text-white mb-5">Edit Submission</a>
            </div>
            <div class="col-3">
                <form action="{{ route('hapus-file') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- Input hidden untuk menyimpan ID file yang akan dihapus -->
                    <input type="hidden" name="id_kirim" value="{{ session('id_kirim') }}">
                    {{-- <button type="submit" class="btn bg-light border-1 text-dark">Remove Submission</button> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
