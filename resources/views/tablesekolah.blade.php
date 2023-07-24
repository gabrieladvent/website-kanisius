@extends('layout-yayasan.second')
@section('isi-content')
    <div class="">
        <div class="judul" style="margin-top: 8%;">
            <p class="fs-3 fw-bold text-wrap text-center">Data Siswa-Siswi SD Sangken</p>
            <p class="fs-3 fw-bold text-wrap text-center">Tahun Ajaran 2023/2024</p>
        </div>
    </div>
    <div class="data-siswa py-3 ">
        <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
            <table id="example" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Sekolah</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                    {{-- @foreach ($data_siswa as $item)
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
                      <td>{{ $item->sekolah->NAMASEKOLAH }}</td>
                      <td>{{ $item->Rombel_Set_Ini }}</td>
                  </tr>
              @endforeach --}}
                </tbody>
                <tfoot>
                    <tr>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Sekolah</th>
                        <th>Kelas</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    </div>
    <div class="row d-flex justify-content-center mt-5 ms-5">
        <div class="col-2 justify-content-center">
            <a href="" class="btn bg-dark text-white">Update Data</a>
        </div>
        <div class="col-3 justify-content-center">
            <a href="" class="btn bg-light text-dark">Download Dan Upload</a>
        </div>
    </div>
    </div>
    </div>
@endsection
