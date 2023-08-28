@php
    $currentYear = date('Y'); // Mengambil tahun saat ini
    $nextYear = $currentYear + 1; // Menambahkan 1 tahun untuk tahun berikutnya
    
    $tahunAjaran = $currentYear . '/' . $nextYear;
@endphp
@extends('layout-yayasan.second')
@section('isi-content')
<div class="px-5"><br></div>
    <div class="data-siswa py-3 mt-5">
        <div class="data-siswa-table" style=" padding-bottom: 1%">
            <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
                @if (isset($data_siswa) && count($data_siswa) > 0)
                    <div class="">
                        <div class="judul" style="">
                            <p class="fs-3 fw-bold text-wrap text-center mt-1">Data Siswa-Siswi
                                {{ $notifikasi->user->namasekolah }}
                            </p>
                            <p class="fs-3 fw-bold text-wrap text-center">Tahun Ajaran {{ $tahunAjaran }}</p>
                        </div>
                    </div>

                    @if (strpos($userKirim, 'TK') === 0)
                        <table id="example" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                @foreach ($data_siswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item[4] }}</td>
                                        <td>{{ $item[1] }}</td>
                                        <td>{{ $item[9] }}</td>
                                        <td>{{ $item[5] == '1' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                        <td>{{ $item[20] }}</td>
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
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row d-flex justify-content-center mt-3 ms-5">
                            <div class="col-3 justify-content-center ms-5">
                                <form action="{{ route('update-data-TK', ['id' => $notifikasi->id_kirim]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn bg-dark text-white">Update Data</button>
                                </form>
                            </div>

                            <div class="col-3 justify-content-center ms-5">
                                <a href="{{ route('update-and-download-TK', ['id' => $notifikasi->id_kirim]) }}"
                                    class="btn btn-white border border-2">Update-Download</a>
                            </div>
                        </div>
                    @else
                        <table id="example" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                @foreach ($data_siswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item[4] }}</td>
                                        <td>{{ $item[1] }}</td>
                                        <td>{{ $item[6] }}</td>
                                        <td>{{ $item[3] == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                        <td>{{ $item[42] }}</td>
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
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row d-flex justify-content-center mt-3 ms-5">
                            <div class="col-3 justify-content-center ms-5">
                                <form action="{{ route('update-data', ['id' => $notifikasi->id_kirim]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn bg-dark text-white">Update Data</button>
                                </form>
                            </div>

                            <div class="col-3 justify-content-center ms-5">
                                <a href="{{ route('update-and-download', ['id' => $notifikasi->id_kirim]) }}"
                                    class="btn btn-white border border-2">Update-Download</a>
                            </div>
                        </div>
                    @endif
                @else

                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            @foreach ($data_siswa as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item[4] }}</td>
                                    <td>{{ $item[1] }}</td>
                                    <td>{{ $item[6] }}</td>
                                    <td>{{ $item[3] == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                    <td>{{ $item[42] }}</td>
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
                            </tr>
                        </tfoot> --}}
                    </table>
                    <div class="row d-flex justify-content-center mt-3 ms-5">
                        <div class="col-3 justify-content-center ms-5">
                            <form action="{{ route('update-data', ['id' => $notifikasi->id_kirim]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn bg-dark text-white">Update Data</button>
                            </form>
                        </div>

                        <div class="col-3 justify-content-center ms-5">
                            <a href="{{ route('update-and-download', ['id' => $notifikasi->id_kirim]) }}" class="btn btn-white border border-2">Update-Download</a>
                        </div>
                    </div>
                @endif
        
            @else
                <div class="px-5 mt-5">

                    <p class="h3">TIDAK ADA DATA YANG DIPILIH</p>
                    <p class="h3">SILAHKAN PILIH DATA</p>
                    <p>Halaman akan secara otomatis dialihkan....</p>
                    <p>Atau Klik <a href="{{ route('notifikasi') }}">Di Sini</a></p>
                    <script>
                        setTimeout(function() {
                            window.location.href = "{{ route('notifikasi') }}";
                        }, 2000);
                    </script>
                @endif
            </div>
        </div>
    </div>
@endsection
