@extends('layout-yayasan.main')
@section('isi-content')
    <div class="col" style="margin-left: 5%; margin-top:5.6%">
        <div class="row mt-3 px-3 ">
            <div class="col-3 ms-3">
                <img src="{{ asset('/image/logo baru.png') }}" class="w-50">
            </div>
            <div class="col-5 mt-5 ms-4 me-1">
                <img src="{{ asset('/image/alamat.png') }}" class="w-75 ms-5" alt="">
            </div>
            <div class="col-3 ms-5">
                <img src="{{ asset('/image/IHS_Logo.png') }}" class="w-75 ms-5" alt="">
            </div>
            <div class="row d-flex justify-content-center border-2 border-top border-primary mt-3 container-fluid shadow-6-strong"
                style="border-radius: 20px">
                <div class="col-1 mt-4">
                    <p>Message</p>
                </div>

                <div class="col">
                    <table class="table table-borderless mt-3 w-100  " style="background-color: #F5F4F4;">
                        <tbody class=" mt-5">
                            @if ($notifikasi->isEmpty())
                                <tr class="">
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                    <td class="text-secondary">Tidak Ada Pesan</td>
                                </tr>
                            @endif
                            @foreach ($notifikasi as $notif)
                                <tr class="border-bottom border-primary border-1">
                                    <th></th>
                                    <td>{{ $users[$notif]->id }} mengirimkan file</td>
                                    <td>
                                        <a href="" class="text-primary">Lihat</a>
                                    </td>
                                    <td>
                                        <a href="" class="text-primary">Download dan Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="col-2 ">
                    <div class="row">
                        <p></p>
                    </div>
                    <div class="row">
                        <p></p>
                    </div>
                    <div class="row">
                        <p></p>
                    </div>
                    <div class="row">
                        <p></p>
                    </div>
                    <div class="row">
                        <p></p>
                    </div>
                    <div class="row">
                        <p></p>
                    </div>
                    <div class="row"><a href="">
                            <p class="fs-6">see More...</p>
                        </a></div>
                </div>
            </div>

            <div class="row d-flex justify-content-center  border-top border-primary border-2 mt-3 container-fluid shadow-6-strong"
                style="border-radius: 20px">
                <div class="col">
                    <table class="table table-borderless mt-3 w-100  " style="background-color: #F5F4F4;">
                        <thead class="">
                            <td class="col-3">Yayasan Kanisius:</td>
                            <td class="col-2">Sekolah Dasar</td>
                            <td class="">Sekolah Menengah Pertama</td>
                        </thead>
                        <tbody class=" mt-5">
                            <tr>
                                <th></th>
                                <td>Sekolah Dasar</td>
                                <td>Sekolah Menengah Pertama</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>Sekolah Dasar</td>
                                <td>Sekolah Menengah Pertama</td>
                            </tr>
                            <tr class="">
                                <th></th>
                                <td>Sekolah Dasar</td>
                                <td>Sekolah Menengah Pertama</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-2 ">
                    <div class="row mt-5"></div>
                    <div class="row mt-5"></div>
                    <div class="row mt-5"></div>
                    <div class="row mt-5"></div>
                    <div class="row"><a href="">
                            <p class="fs-6">see More...</p>
                        </a></div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
