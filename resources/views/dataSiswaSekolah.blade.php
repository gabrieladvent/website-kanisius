@extends('layout-sekolah.second')
@section('isi-content')
    <div class="">
        <div class="judul" style="margin-top: 8%;">
            <p class="fs-3 fw-bold text-wrap text-center">Data Siswa-Siswi {{ $user->namasekolah }}</p>
            <p class="fs-3 fw-bold text-wrap text-center">Tahun Ajaran 2023/2024</p>
        </div>
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="dropdown" style="margin-left: 12vw;">
                <select id="dropdown1" class="dropdown-select">
                    <option selected>Bulan</option>
                    <option value="opsi1">Januari</option>
                    <option value="opsi2">Februari</option>
                    <option value="opsi4">Maret</option>
                    <option value="opsi5">April</option>
                    <option value="opsi6">Mei</option>
                    <option value="opsi7">Juni</option>
                    <option value="opsi8">Juli</option>
                    <option value="opsi9">Agustus</option>
                    <option value="opsi10">September</option>
                    <option value="opsi11">November</option>
                    <option value="opsi12">Desember</option>
                </select>
                <select id="dropdown2" class="dropdown-select">
                    <option selected>Tahun</option>
                    <option value="pilihan1">2022</option>
                    <option value="pilihan2">2023</option>
                    <option value="pilihan3">2024</option>
                </select>
            </div>
        </div>
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
                                <a href="#" class="btn btn-primary">Detail</a>
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
