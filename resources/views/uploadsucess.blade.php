@extends('layout-sekolah.second')
@section('isi-content')
    <div class="col mt-5 px-5 container-fluid shadow-6-strong">
        <div class="row">
            <p class="text-dark mt-5 h2 fw-bold">Submission Status</p>
        </div>
        <div class="item-bar" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
            <div class="row mt-5">
                <div class="col-2 mt-3 ms-2">
                    <p class="text-dark h5 mt-2">Submission Status</p>
                </div>
                <div class="col py-2 items" style="background-color: #CEEECE;">
                    <p class="h4 fw-bold mt-1" style="letter-spacing: 3px">Submitted</p>
                </div>
            </div>
        </div>

        <div class="item-bar" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
            <div class="row mt-5">
                <div class="col-2 mt-3 ms-2">
                    <p class="text-dark h5 mt-2">Last Modified</p>
                </div>
                <div class="col py-2">
                    <p class="h5 mt-2">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
                </div>
            </div>
        </div>

        <div class="item-bar" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
            <div class="row mt-5">
                <div class="col-2 mt-3 ms-2">
                    <p class="text-dark h5 mt-2">File Submissions</p>
                </div>
                <div class="col py-2">
                    <p class="h5 mt-2"><i class="fa-solid fa-file-excel fa-xl me-3"></i>{{ session('filename') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="item-bar" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
            <div class="row mt-5">
                <div class="col-2 mt-2 ms-2">
                    <p class="text-dark h5 mt-2">Comments Submissions</p>
                </div>
                <div class="col py-2">
                    @if (session('komentar') !== '')
                        <p class="h5 mt-2"><i class="fa-xl me-2"></i>{{ session('komentar') }}</p>
                    @else
                        <p class="h5 mt-2"><i class="fa-xl me-2"></i>Tidak Ada komentar</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="mb-5">
            <div class="row mt-5 mb-5 d-flex justify-content-center">
                <div class="col-2 mb-5">
                    <a href="/sekolah/2032/upload?edit=true" class="btn bg-dark text-white mb-5">Edit Submission</a>
                </div>
                <div class="col-3">
                    <form action="{{ url('remove') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn bg-light border-1 text-dark">Remove Submission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
