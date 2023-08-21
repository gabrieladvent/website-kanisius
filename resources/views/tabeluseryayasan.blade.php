@extends('layout-yayasan.second')
@section('isi-content')
        <div class="judul" style="margin-top: 8%;">
            <p class="fs-3 fw-bold text-wrap text-center">Data Siswa-Siswi</p>
            <p class="fs-3 fw-bold text-wrap text-center">Tahun Ajaran 2023/2024</p>
        </div>


    <div class="data-siswa py-3 ">
        <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
            <table id="example" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Sekolah</th>
                        <th>Kelas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_siswa as $item)
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
                            <td>{{ $item->sekolah->NAMASEKOLAH }}</td>
                            <td>{{ $item->Rombel_Set_Ini }}</td>
                            <td><a href="{{ route('detail-siswa-personal', ['nisn' => $item->NISN]) }}" class="btn btn-primary">Detail</a></td>
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
                        <th>Kelas</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
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
