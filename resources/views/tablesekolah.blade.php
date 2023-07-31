@extends('layout-yayasan.second')
@section('isi-content')
    <div class="data-siswa" style="margin-top: 6%; padding-bottom: 1%">
        <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
            @if (isset($data_siswa) && count($data_siswa) > 0)
                <div class="">
                    <div class="judul" style="margin-top: 10%;">
                        <p class="fs-3 fw-bold text-wrap text-center">Data Siswa-Siswi {{ $notifikasi->user->namasekolah }}
                        </p>
                        <p class="fs-3 fw-bold text-wrap text-center">Tahun Ajaran 2023/2024</p>
                    </div>
                </div>
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
                    <form action="{{ route('update-data', ['id' => $notifikasi->id_kirim]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn bg-dark text-white">Update Data</button>
                    </form>
            
                    <div class="col-3 justify-content-center ms-5">
                        <a href="" class="btn bg-light text-dark">Download Dan Update</a>
                    </div>
                </div>
            @else
                <div class="px-5 mt-5">
                    <p class="h3">TIDAK ADA DATA YANG DIPILIH</p>
                    <p class="h3">SILAHKAN PILIH DATA</p>
                    <p class="mt-5">Halaman akan secara otomatis dialihkan....</p>
                    <p class="">Atau Klik <a href="{{ route('notifikasi') }}">Di Sini</a></p>
                    <script>
                        setTimeout(function() {
                            window.location.href = "{{ route('notifikasi') }}";
                        }, 2000);
                    </script>
                </div>
            @endif
        </div>
    </div>
@endsection
