@extends('layout-yayasan.second')
@section('isi-content')

@if ($isFromShow && isset($notifikasi) && count($notifikasi) > 0)
<div class="data-siswa py-5 " style="background: #244076;">
    <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
    <div class="card">
        <div class="card-header" style="background: #89a5dd; display: flex; align-items: center;">
            <h2 style="margin: 0;">Message</h2>
            <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
            <lord-icon
                src="https://cdn.lordicon.com/msetysan.json"
                trigger="hover"
                colors="primary:#121331"
                style="width: 45px; height: 30px; margin-left: 10px;">
            </lord-icon>
        </div>
        
            <div class="message-box" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);padding:1%">

                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Nomor</th>
                            <th>Nama Sekolah</th>
                            <th>Nama File</th>
                            <th>Komentar</th>
                            <th>Tanggal Kirim</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $true = [];
                            $false = [];
                        @endphp
                        @foreach ($notifikasi as $notif)
                            @if ($notif->status == 1)
                                @php $false[] = $notif; @endphp
                            @else
                                @php $true[] = $notif; @endphp
                            @endif
                        @endforeach

                        @foreach (\Auth::user()->notifications as $notif)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                                <td>{{ $notif->data['namasekolah'] }} </td>
                                <td>{{ $notif->data['name'] }}</td>
                                <td>{{ $notif->data['komen'] }}</td>
                                <td>{{ $notif->created_at->format('Y-m-d') }}</td>
                                <td>Belum Di Baca</td>
                                <td>
                                    <a href="{{ route('show-notifikasi', ['id' => $notif->id]) }}">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        <tr><td colspan="7"></td></tr>

                        @foreach ($true as $notif)
                            <tr class="table-secondary text-secondary">
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
                                <td>{{ $notif->updated_at->format('Y-m-d') }}</td>
                                <td>
                                    Sudah Dibaca
                                </td>
                                <td class="">Tidak Ada Action</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    @elseif(!$isFromShow && !$dataSekolah->isEmpty())
        <div class="ms-5 mt-5">
            <div class="mt-5">
                <h2 class="fw-bold text-center mb-5 pt-5">Daftar Sekolah <br> Di Kanisius Cabang Yogyakarta </h2>
            </div>
            <div class="message-box p-3" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);">

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
                    {{-- @endforeach   --}}
@endsection
