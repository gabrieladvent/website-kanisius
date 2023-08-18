@php
    $notificationCount = $notifikasi->count();
@endphp

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
            <div style="position: relative;">
                <div class="row d-flex justify-content-center border-2 border-top border-primary mt-3 container-fluid shadow-6-strong"
                    style="border-radius: 20px">
                    <div class="col-1 mt-4">
                        <p>Message</p>
                    </div>

                    <div class="col special-col">
                        <table class="table table-borderless mt-3 w-100">
                            <tbody class="mt-5">
                                @if ($notifikasi->isEmpty())
                                    <tr>
                                        {{-- <th></th>
                                        <td></td> --}}
                                        <td class="centered-message" colspan="2">Tidak Ada Pesan</td>
                                    </tr>
                                    <tr>
                                        <td class="centered-message" colspan="2">Tidak Ada Pesan</td>

                                    </tr>
                                @else
                                    @foreach ($notifikasi as $index => $notif)
                                        <tr class="border-bottom border-primary border-1">
                                            <th></th>
                                            <td>{{ $notif->user->namasekolah }} mengirimkan file</td>
                                            <td>
                                                <a href="{{ route('show-notifikasi', ['id' => $notif->id_kirim]) }}">Lihat</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('update-and-download', ['id' => $notif->id_kirim]) }}" class="text-primary">Download dan Update</a>
                                            </td>
                                        </tr>
                                        @if ($index === 1 && $notificationCount > 2)
                                        @break
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-1">
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
                    <div class="row">
                        @if ($notificationCount > 2)
                            <a href="{{ route('notifikasi') }}" class="fs-6">See More...</a>
                        @endif
                    </div>
                </div>
            </div>


            <div class="row d-flex justify-content-center  border-top border-primary border-2 mt-3 container-fluid shadow-6-strong"
                style="border-radius: 20px">
                <div class="col">
                    @php
                        $tempTK = [];
                        $tempSD = [];
                        $tempSMP = [];
                    @endphp

                    @foreach ($dataSekolah as $item)
                        @if (strpos($item->NAMASEKOLAH, 'TK') !== false)
                            @php
                                $tempTK[] = $item->NAMASEKOLAH;
                            @endphp
                        @elseif (strpos($item->NAMASEKOLAH, 'SD') !== false)
                            @php
                                $tempSD[] = $item->NAMASEKOLAH;
                            @endphp
                        @else
                            @php
                                $tempSMP[] = $item->NAMASEKOLAH;
                            @endphp
                        @endif
                    @endforeach

                    {{-- Tampilkan data yang sudah disimpan dalam array dengan batasan 5 data --}}
                    <table class="table table-borderless mt-3 w-100 custom-table">
                        <thead>
                            <th class="col-2">Yayasan Kanisius:</th>
                            <th class="col-3">Taman Kanak (TK)</th>
                            <th class="col-3">Sekolah Dasar (SD)</th>
                            <th class="col-4">Sekolah Menengah Pertama (SMP)</th>
                        </thead>
                        <tbody class="mt-5 table-group-divider">
                            <tr class="">
                                <td></td>
                                <td>
                                    <ol>
                                        @foreach ($tempTK as $index => $namaTK)
                                            @if ($loop->iteration <= 5)
                                                <li>{{ $namaTK }}</li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </td>
                                <td>
                                    <ol>
                                        @foreach ($tempSD as $index => $namaSD)
                                            @if ($loop->iteration <= 5)
                                                <li>{{ $namaSD }}</li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </td>
                                <td>
                                    <ol>
                                        @foreach ($tempSMP as $index => $namaSMP)
                                            @if ($loop->iteration <= 5)
                                                <li>{{ $namaSMP }}</li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </td>
                                <td>
                                    <a href="{{ route('daftar-sekolah') }}" class="see-more-link">
                                        <p class="fs-6 custom-text-style">See More...</p>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- <div class="col-1">
                    <div class="row mt-5"></div>
                    <div class="row mt-5"></div>
                    <div class="row mt-5"></div>
                    <div class="row mt-5"></div>
                    <div class="row">
                        <a href="{{ route('daftar-sekolah') }}">
                            <p class="fs-10">see More...</p>
                        </a>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</div>
<script>
    
</script>
@endsection
