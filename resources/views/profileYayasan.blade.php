@extends('layout-yayasan.second')
@section('isi-content')
<style>
    .svg-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
</style>
<div class="svg-container">
    <svg id="visual" viewBox="0 0 900 600" width="990" height="790"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><path d="M654 0L617 14.7C580 29.3 506 58.7 478.2 87.8C450.3 117 468.7 146 470.2 175.2C471.7 204.3 456.3 233.7 477 262.8C497.7 292 554.3 321 581.8 350.2C609.3 379.3 607.7 408.7 566.8 437.8C526 467 446 496 432 525.2C418 554.3 470 583.7 509.7 612.8C549.3 642 576.7 671 590.3 685.5L604 700L0 700L0 685.5C0 671 0 642 0 612.8C0 583.7 0 554.3 0 525.2C0 496 0 467 0 437.8C0 408.7 0 379.3 0 350.2C0 321 0 292 0 262.8C0 233.7 0 204.3 0 175.2C0 146 0 117 0 87.8C0 58.7 0 29.3 0 14.7L0 0Z" fill="#c6cfdd"></path><path d="M312 0L316.8 14.7C321.7 29.3 331.3 58.7 341.5 87.8C351.7 117 362.3 146 374.2 175.2C386 204.3 399 233.7 387.7 262.8C376.3 292 340.7 321 355.5 350.2C370.3 379.3 435.7 408.7 455 437.8C474.3 467 447.7 496 451.3 525.2C455 554.3 489 583.7 495.2 612.8C501.3 642 479.7 671 468.8 685.5L458 700L0 700L0 685.5C0 671 0 642 0 612.8C0 583.7 0 554.3 0 525.2C0 496 0 467 0 437.8C0 408.7 0 379.3 0 350.2C0 321 0 292 0 262.8C0 233.7 0 204.3 0 175.2C0 146 0 117 0 87.8C0 58.7 0 29.3 0 14.7L0 0Z" fill="#8ea7d8"></path><path d="M310 0L311.7 14.7C313.3 29.3 316.7 58.7 314.8 87.8C313 117 306 146 306.2 175.2C306.3 204.3 313.7 233.7 325.2 262.8C336.7 292 352.3 321 346.2 350.2C340 379.3 312 408.7 317 437.8C322 467 360 496 375.5 525.2C391 554.3 384 583.7 354.3 612.8C324.7 642 272.3 671 246.2 685.5L220 700L0 700L0 685.5C0 671 0 642 0 612.8C0 583.7 0 554.3 0 525.2C0 496 0 467 0 437.8C0 408.7 0 379.3 0 350.2C0 321 0 292 0 262.8C0 233.7 0 204.3 0 175.2C0 146 0 117 0 87.8C0 58.7 0 29.3 0 14.7L0 0Z" fill="#5e7dcf"></path><path d="M256 0L260.5 14.7C265 29.3 274 58.7 269 87.8C264 117 245 146 229.5 175.2C214 204.3 202 233.7 189.3 262.8C176.7 292 163.3 321 177.3 350.2C191.3 379.3 232.7 408.7 252.5 437.8C272.3 467 270.7 496 252.5 525.2C234.3 554.3 199.7 583.7 207 612.8C214.3 642 263.7 671 288.3 685.5L313 700L0 700L0 685.5C0 671 0 642 0 612.8C0 583.7 0 554.3 0 525.2C0 496 0 467 0 437.8C0 408.7 0 379.3 0 350.2C0 321 0 292 0 262.8C0 233.7 0 204.3 0 175.2C0 146 0 117 0 87.8C0 58.7 0 29.3 0 14.7L0 0Z" fill="#3552c1"></path><path d="M196 0L185 14.7C174 29.3 152 58.7 140.8 87.8C129.7 117 129.3 146 132.5 175.2C135.7 204.3 142.3 233.7 136 262.8C129.7 292 110.3 321 111.8 350.2C113.3 379.3 135.7 408.7 146.5 437.8C157.3 467 156.7 496 150.3 525.2C144 554.3 132 583.7 130 612.8C128 642 136 671 140 685.5L144 700L0 700L0 685.5C0 671 0 642 0 612.8C0 583.7 0 554.3 0 525.2C0 496 0 467 0 437.8C0 408.7 0 379.3 0 350.2C0 321 0 292 0 262.8C0 233.7 0 204.3 0 175.2C0 146 0 117 0 87.8C0 58.7 0 29.3 0 14.7L0 0Z" fill="#1820ab"></path></svg>
</div>
<div class="row px-5">
    <div class="col-4  mt-5 py-4 px-5">
        <div class="row mt-5 shadow-3-strong" style="background-color: #ffffff;">
            <div class="col mt-3 ms-4  ">
                <p class="fw-bold"> {{ $user->id }} </p>
                <p class="fw-bold">{{ $user->name }}</p>
                <p class="fw-bold">{{ $user->namasekolah }}</p>
            </div>
            <div class="col mt-3">
                <img class="float-end" src="{{ asset('/icon/user-tie-solid.svg') }}" width="100px" alt="">
            </div>
        </div>
    </div>
    <div class="col  mt-5 py-4 px-5" >
        <div class="row mt-5 d-flex justify-content-center shadow-3-strong" style="background-color: #ffffff;">
            <div class="col-3 mt-5 mb-3  text-center">
                <a href="" class="btn bg-light  ">Edit Tema</a>
                <div class="row  text-center mt-3">
                    <a href="akun-yayasan" class="btn bg-light  ">AKun Yayasan</a>
                </div>
            </div>
        </div>
        <div class="row mt-3 py-5 shadow-3-strong" style="background-color: #ffffff;">
            <p class="text-center fs-5">Upload Tema Disini</p>
            <form action="{{ route('update.profile')}}" method="post" enctype="multipart/form-data">
                @csrf

                <fieldset class="upload_dropZone text-center mb-2 p-2">
                    <legend class="visually-hidden">Image uploader</legend>
                    <svg class="upload_svg" width="60" height="60" aria-hidden="true">
                        <use href="#icon-imageUpload"></use>
                    </svg>
                    <p class="small my-2">Drag &amp; Drop tema gambar(s) dengan format png<br><i>or</i>
                    </p>
                    <input id="upload_image_background" data-post-name="image_background" data-post-url="{{route('update.profile')}}" class="position-absolute invisible"  type="file" name="photo" multiple accept="image/png" />
                    <label class="btn btn-upload mb-3" for="upload_image_background">Choose
                        file(s)</label>
                    <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0"></div>
                </fieldset>
                <div class="row">
                    <div class="col mt-1">
                        <button type="submit"  class=" float-end fs-6 btn bg-primary text-white">Submit</button>
                    </div>
                </div>
            </form>

            <svg style="display:none">
                <defs>
                    <symbol id="icon-imageUpload" clip-rule="evenodd" viewBox="0 0 96 96">
                        <path d="M47 6a21 21 0 0 0-12.3 3.8c-2.7 2.1-4.4 5-4.7 7.1-5.8 1.2-10.3 5.6-10.3 10.6 0 6 5.8 11 13 11h12.6V22.7l-7.1 6.8c-.4.3-.9.5-1.4.5-1 0-2-.8-2-1.7 0-.4.3-.9.6-1.2l10.3-8.8c.3-.4.8-.6 1.3-.6.6 0 1 .2 1.4.6l10.2 8.8c.4.3.6.8.6 1.2 0 1-.9 1.7-2 1.7-.5 0-1-.2-1.3-.5l-7.2-6.8v15.6h14.4c6.1 0 11.2-4.1 11.2-9.4 0-5-4-8.8-9.5-9.4C63.8 11.8 56 5.8 47 6Zm-1.7 42.7V38.4h3.4v10.3c0 .8-.7 1.5-1.7 1.5s-1.7-.7-1.7-1.5Z M27 49c-4 0-7 2-7 6v29c0 3 3 6 6 6h42c3 0 6-3 6-6V55c0-4-3-6-7-6H28Zm41 3c1 0 3 1 3 3v19l-13-6a2 2 0 0 0-2 0L44 79l-10-5a2 2 0 0 0-2 0l-9 7V55c0-2 2-3 4-3h41Z M40 62c0 2-2 4-5 4s-5-2-5-4 2-4 5-4 5 2 5 4Z" />
                    </symbol>
                </defs>
            </svg>

        </div>
    </div>
</div>
@endsection
