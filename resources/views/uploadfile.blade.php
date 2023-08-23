@php
    use Carbon\Carbon;
@endphp

@extends('layout-sekolah.second')
@section('isi-content')
    @if (\Carbon\Carbon::now()->between(\Carbon\Carbon::parse($upload_start), \Carbon\Carbon::parse($upload_end)))
        <div class="isi-main px-5">
            <div class="row">
                <div class="col fw-bold mt-5 px-5">
                    <p class="px-3 h2 mt-4 fw-bold">File Submissions
                        <a href="{{ route('template-excel') }}" target="_b" rel="noopener noreferrer">
                            <i class="fas fa-exclamation-circle" style="font-size: 16px;" title="Download Template"></i>
                        </a>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col">
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
            </div>

            <div class="row ms-4">
                <div class="col ps-2">
                    <p class="">Accepted file type: xlsx, xls, csv</p>
                </div>
            </div>

            <div class="second-box ms-4">
                <div class="p-3 px-5" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">
                    <div class="row ">
                        <div class="col">
                            <input type="text" class="w-100 pb-5 border border-dark container-fluid shadow-3-strong"
                                name="komentar" style="height: 150px;"
                                placeholder="Silahkan masukan komentar atau pesan...">
                        </div>
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
        </div>
    @else
        <div class="isi-main px-5">
            <div class="row">
                <div class="col fw-bold mt-5 px-5">
                    <p class="px-3 h2 mt-4 fw-bold">Portal Belum Dibuka
                        <a href="{{ route('template-excel') }}" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-exclamation-circle" style="font-size: 16px;" title="Download Template"></i>
                        </a>
                    </p>
                    <p href="#" class="px-3 h3 fw-bold">Silahkan Hubungi Admin</p>
                </div>
            </div>
        </div>
    @endif
@endsection
