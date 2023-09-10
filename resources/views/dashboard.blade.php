@php
    $notificationCount = count($user->notifications);
    $shownNotifications = 0;
@endphp

@extends('layout-yayasan.main')
@section('isi-content')
    <div class="col" style="margin-left: 5%; margin-top:5.6%">
        <div class="row mt-3 px-3 ">
            <div class="col-3 ms-3">
                <img src="{{ asset('/image/logo-kapal-fix.png') }}" class="w-50">
            </div>
            <div class="col-5 mt-5 ms-4 me-1">
                <img src="{{ asset('/image/logo-tengah-fix-.png') }}" class="w-100 ms-2" alt="" loading="lazy">
            </div>
            <div class="col-3 ms-5">
                <img src="{{ asset('/image/logo-ihs-fix.png') }}" class="w-75 ms-5" alt="">
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
                                @forelse ($user->notifications as $notification)
                                    @if ($shownNotifications < 2)
                                        <tr>
                                            <td>
                                                <span class="notification-row" style="padding: 1%">
                                                    <a href="{{ route('show-notifikasi', ['id' => $notification->id]) }}"
                                                        style="color: black" class="fw-bold h5">
                                                        <span class="">
                                                            {{ $notification->data['namasekolah'] }}
                                                        </span>
                                                        Mengirimkan File
                        
                                                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                                        <lord-icon src="https://cdn.lordicon.com/pkmkagva.json"
                                                            trigger="hover" colors="primary:#66a1ee"
                                                            style="width:25px;height:25px;margin-left:10px;float: right; ">
                                                        </lord-icon>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                        @php
                                            $shownNotifications++;
                                        @endphp
                                    @endif
                                @empty
                                    <tr>
                                        <td class="centered-message" style="color :rgb(246, 255, 0)" colspan="2">Tidak Ada Pesan</td>
                                    </tr>
                                @endforelse
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
                        <div class="row ">
                            @if ($notificationCount > 2)
                                <a href="{{ route('notifikasi') }}" class="see-more">See More>></a>
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
                        <table class="table table-borderless mt-3 w-100 custom-table" style="background-color: #ffffff;">
                            <thead>
                                <th class="col-2">Yayasan Kanisius:</th>
                                <th class="col-3">Taman Kanak (TK)</th>
                                <th class="col-3">Sekolah Dasar (SD)</th>
                                <th class="col-4">Sekolah Menengah Pertama (SMP)</th>
                            </thead>
                            <tbody class="mt-5 table-group-divider">
                                <tr class="">
                                    <td></td>
                                    <td style="padding-top: 0;">
                                        <ol>
                                            @foreach ($tempTK as $index => $namaTK)
                                                @if ($loop->iteration <= 5)
                                                    <li>{{ $namaTK }}</li>
                                                @endif
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td style="padding-top: 0;">
                                        <ol>
                                            @foreach ($tempSD as $index => $namaSD)
                                                @if ($loop->iteration <= 5)
                                                    <li>{{ $namaSD }}</li>
                                                @endif
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td style="padding-top: 0;">
                                        <ol>
                                            @foreach ($tempSMP as $index => $namaSMP)
                                                @if ($loop->iteration <= 5)
                                                    <li>{{ $namaSMP }}</li>
                                                @endif
                                            @endforeach
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">
                                        <a href="{{ route('daftar-sekolah') }}" class="d-block text-center see-more-link"
                                            style="padding-top: -10px;">
                                            <p class="fs-10">See More &gt;&gt;&gt;</p>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
