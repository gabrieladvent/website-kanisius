@php
    $currentYear = date('Y'); // Mengambil tahun saat ini
    $nextYear = $currentYear + 1; // Menambahkan 1 tahun untuk tahun berikutnya

    $tahunAjaran = $currentYear . '/' . $nextYear;
@endphp
@extends('layout-sekolah.second')
@section('isi-content')

<div class="data-siswa py-4" style="background: #fcfcfc; margin-top: 6%;">
    <div class="table-data d-flex justify-content-center align-items-center" style="margin-left: 1%; margin-right: 1%; height: 100%;">
        <div>
            <p class="fs-3 fw-bold text-wrap text-center">Data Siswa-Siswi {{ $user->namasekolah }}</p>
            <p class="fs-3 fw-bold text-wrap text-center">Tahun Ajaran {{ $tahunAjaran }}</p>
        </div>
    </div>
</div>





    <div class="data-siswa py-3 ">
        <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
            <table id="example" class="table table-bordered" style="width:100%">
                @if (strpos($isTK, 'TK') === 0)
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Sekolah</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($TK as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->NISN }}</td>
                                <td>{{ $item->nama_siswa }}</td>
                                <td>{{ $item->tanggal_lahir }}</td>
                                <td>
                                    @if ($item->gender == '1')
                                        Laki-Laki
                                    @elseif ($item->gender == '2')
                                        Perempuan
                                    @endif
                                </td>
                                <td>{{ $item->sekolah->NAMASEKOLAH }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('detail-siswa-personal', ['nisn' => $item->NISN, 'namasekolah' => $item->sekolah->NAMASEKOLAH]) }}"
                                        class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Sekolah</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                @else
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->NISN }}</td>
                                <td>{{ $item->Nama }}</td>
                                <td>{{ $item->Tanggal_Lahir }}</td>
                                <td>
                                    @if ($item->JK == 'L')
                                        Laki-Laki
                                    @elseif ($item->JK == 'P')
                                        Perempuan
                                    @endif
                                </td>
                                <td>{{ $item->Rombel_Set_Ini }}</td>
                                <td>
                                    <a href="{{ route('detail-siswa-personal', ['nisn' => $item->NISN, 'namasekolah' => $item->sekolah->NAMASEKOLAH]) }}"
                                        class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> --}}
                @endif

            </table>
        </div>
    </div>
    </div>

    <!-- pop up -->
    <div class="filter-popup" id="filterPopup">
        <button type="button" class="btn btn-primary" id="applyBtn" hidden>Apply</button>
        <button type="button" class="btn btn-secondary" id="closeBtn" hidden>Close</button>
    </div>
@endsection

{{-- @section('script')
<script>
    (() => {
        const data = {!! $data !!}
        console.log(data)

    })()
</script>
@endsection --}}
