@extends('layout-yayasan.second')
@section('isi-content')
<div class="toper">
    <h2>Message</h2>
    <div class="message-box" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);padding:1%">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Sekolah</th>
                <th>Nama File</th>
                <th>Komentar</th>
                <th>Tanggal Waktu Kirim</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifikasi as $notif)
            <tr>
                
                <td>{{ $loop->iteration }}</td>
                <td>{{ $notif->user->namasekolah }}</td>
                <td>{{ $notif->nama_file }}</td>
                <td>
                    @unless (empty($notif->Komentar))
                        {{ $notif->Komentar }}
    @if ($isFromShow && isset($notifikasi) && count($notifikasi) > 0)
        <div class="toper">
            <h2>Message</h2>
            <div class="message-box" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);padding:1%">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Sekolah</th>
                            <th>Nama File</th>
                            <th>Komentar</th>
                            <th>Tanggal Waktu Kirim</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifikasi as $notif)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $notif->user->namasekolah }}</td>
                                <td>{{ $notif->nama_file }}</td>
                                <td>
                                    @unless (empty($notif->Komentar))
                                        {{ $notif->Komentar }}
                                    @else
                                        Tidak ada komentar
                                    @endunless
                                </td>
                                <td>{{ $notif->created_at }}</td>
                                <td>
                                    <a href="{{ route('show-notifikasi', ['id' => $notif->id_kirim]) }}"
                                        class="btn btn-primary">Lihat</a>
                                    <a href="#" class="btn btn-primary">Downlaod dan Upload</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif(!$isFromShow && !$dataSekolah->isEmpty())
        <div class="ms-5 mt-5">
            <div class="mt-5">
                <h2 class="fw-bold text-center mb-5 pt-5">Daftar Sekolah <br> Di Kanisius Cabang Yogyakarta </h2>
            </div>
            <div class="message-box p-3" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">

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

                <table class="table table-bordered border border-secondary" style="background-color: #ffffff;">
                    <thead class="">
                        <th class="h4 fw-bold">Yayasan Kanisius:</th>
                        <th class="h4 fw-bold text-center col-3">Taman Kanak (TK)</th>
                        <th class="h4 fw-bold text-center col-3">Sekolah Dasar (SD)</th>
                        <th class="h4 fw-bold text-center col-4">Sekolah Menengah Pertama (SMP)</th>
                    </thead>
                    <tbody class=" mt-5 table-group-divider">
                        <tr class="">
                            <td></td>
                            <td>
                                <ol>
                                    @foreach ($tempTK as $index => $namaTK)
                                        <li>{{ $namaTK }}</li>
                                    @endforeach
                                </ol>
                            </td>
                            <td>
                                <ol>
                                    @foreach ($tempSD as $index => $namaSD)
                                        <li>{{ $namaSD }}</li>
                                    @endforeach
                                </ol>
                            </td>
                            <td>
                                <ol>
                                    @foreach ($tempSMP as $index => $namaSMP)
                                        <li>{{ $namaSMP }}</li>
                                    @endforeach
                                </ol>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="toper text-center mt-5">
            <h2>TIDAK ADA PESAN</h2>
        </div>
    @endif
@endsection
