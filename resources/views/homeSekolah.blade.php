@extends('layout-sekolah.main')
@section('isi-content')
    <div class="content">
        <div class="logo-banner">
            <table>
                <tr>
                    <th> <i><img src="{{ asset('/image/logo.png') }}" class="img-kanisius-baru"></i></th>
                    <th>
                        <i><img src="{{ asset('/image/alamat.png') }}" class="branding-baru"> <span></span></i>
                    </th>
                    <th><i><img src="{{ asset('/image/ihs-baru.png') }}" class="ihs-logo-baru"></i></th>
                </tr>
            </table>
        </div>
        <div class="data-siswa">
            <div class="judul" style="margin-top: 4%;">
                <p class="fs-3 fw-bold text-wrap text-center">Data Siswa-Siswi <strong class="datasiswadas">{{ $user->namasekolah }}</strong></p>
                <p class="fs-3 fw-bold text-wrap text-center">Tahun Ajaran 2023/2024</p>
            </div>
            <div class=" table-data" style="margin-top: -1%; margin-left: 1%; margin-right:1%;">
                <table id="example" class="table table-striped" style="width:100%">
                    @if (strpos($isTK, 'TK') === 0)
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
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
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <center><a href="{{ route('data-siswa', ['slug' => $user->slug]) }}">Lihat Lengkap</a></center>
                                </td>
                            </tr>
                        </tfoot>
                    @else
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
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
                                </tr>
                            @endforeach
                            <tr>
                                <td>NISN</td>
                                <td>Nama Siswa</td>
                                <td>Tanggal Lahir</td>
                                <td>Jenis Kelamin</td>
                                <td>Kelas</td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <center><a href="{{ route('data-siswa', ['slug' => $user->slug]) }}">Lihat Lengkap</a>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    @endif

                </table>
            </div>
        </div>
    </div>
@endsection
