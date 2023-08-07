@extends('layout-yayasan.second')
@section('isi-content')
<div class="svg-container">
    <svg width="100%" height="100%" id="svg" viewBox="0 0 1440 590" xmlns="http://www.w3.org/2000/svg" class="transition duration-300 ease-in-out delay-150"><style>
        .path-0{
          animation:pathAnim-0 4s;
          animation-timing-function: linear;
          animation-iteration-count: infinite;
        }
        @keyframes pathAnim-0{
          0%{
            d: path("M 0,600 C 0,600 0,300 0,300 C 199.59999999999997,292 399.19999999999993,284 556,265 C 712.8000000000001,246 826.8,216 967,220 C 1107.2,224 1273.6,262 1440,300 C 1440,300 1440,600 1440,600 Z");
          }
          25%{
            d: path("M 0,600 C 0,600 0,300 0,300 C 111.59999999999997,261.6 223.19999999999993,223.20000000000002 410,216 C 596.8000000000001,208.79999999999998 858.8000000000002,232.8 1043,252 C 1227.1999999999998,271.2 1333.6,285.6 1440,300 C 1440,300 1440,600 1440,600 Z");
          }
          50%{
            d: path("M 0,600 C 0,600 0,300 0,300 C 155.59999999999997,266.26666666666665 311.19999999999993,232.53333333333333 480,223 C 648.8000000000001,213.46666666666667 830.8,228.13333333333333 993,245 C 1155.2,261.8666666666667 1297.6,280.93333333333334 1440,300 C 1440,300 1440,600 1440,600 Z");
          }
          75%{
            d: path("M 0,600 C 0,600 0,300 0,300 C 163.46666666666664,271.4666666666667 326.9333333333333,242.93333333333334 476,240 C 625.0666666666667,237.06666666666666 759.7333333333333,259.7333333333333 918,274 C 1076.2666666666667,288.2666666666667 1258.1333333333332,294.1333333333333 1440,300 C 1440,300 1440,600 1440,600 Z");
          }
          100%{
            d: path("M 0,600 C 0,600 0,300 0,300 C 199.59999999999997,292 399.19999999999993,284 556,265 C 712.8000000000001,246 826.8,216 967,220 C 1107.2,224 1273.6,262 1440,300 C 1440,300 1440,600 1440,600 Z");
          }
        }</style><defs><linearGradient id="gradient" x1="21%" y1="91%" x2="79%" y2="9%"><stop offset="5%" stop-color="#0d1282"></stop><stop offset="95%" stop-color="#0693e3"></stop></linearGradient></defs><path d="M 0,600 C 0,600 0,300 0,300 C 199.59999999999997,292 399.19999999999993,284 556,265 C 712.8000000000001,246 826.8,216 967,220 C 1107.2,224 1273.6,262 1440,300 C 1440,300 1440,600 1440,600 Z" stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="1" class="transition-all duration-300 ease-in-out delay-150 path-0" transform="rotate(-180 720 300)"></path></svg>
</div>
    <div class="">
        <div class="judul">
            <div class="judul-container">
                <p class="fs-3 fw-bold text-wrap">Data Siswa-Siswi SD Sengken </p>
                <p class="fs-3 fw-bold text-wrap">Tahun Ajaran 2023/2024</p>
            </div>
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
