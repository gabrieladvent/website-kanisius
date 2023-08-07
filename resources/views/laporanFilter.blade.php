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
            <p class="fs-3 fw-bold text-wrap">Laporan Penghasilan </p>
        </div>
    </div>

    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
        <form action="" method="post" style="margin-left: 12vw;">
            <select id="tingkatan" name="tingkatan">
                <option selected> Tingkatan sekolah </option>
                <option value="TK">TK</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
            </select>
    
            <select id="namaSekolah" name="namaSekolah">
                <option selected>Nama Sekolah</option>
                <!-- Options for the school dropdown -->
            </select>
            <select id="kelasTK" name="kelasTK">
                <option selected>TK</option>
                <option value="TK kelas A">A</option>
                <option value="TK kelas B">B</option>
                <!-- Options for the class dropdown -->
            </select>
            <select id="kelasSD" name="kelasSD">
                <option selected>SD</option>
                <option value="SD kelas 1">1</option>
                <option value="SD kelas 2">2</option>
                <option value="SD kelas 3">3</option>
                <option value="SD kelas 4">4</option>
                <option value="SD kelas 5">5</option>
                <option value="SD kelas 6">6</option>
                <!-- Options for the class dropdown -->
            </select>
            <select id="kelasSMP" name="kelasSMP">
                <option selected>SMP</option>
                <option value="SMP kelas 1">1</option>
                <option value="SMP kelas 2">2</option>
                <option value="SMP kelas 3">3</option>
                <!-- Options for the class dropdown -->
            </select>
    
            <select id="kategoriPenghasilan" name="kategoriPenghasilan">
                <option selected >Kategori</option>  
                <option value="Ayah">Ayah</option>
                <option value="Ibu">Ibu</option>
                <option value="Wali Murid">Wali Murid</option>
            </select>
            <button type="submit" class="btn btn-success">Filter</button>
        </form>
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
                @foreach ($data_siswa as $item)
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
                @endforeach
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
<!-- pop up -->
<div class="filter-popup" id="filterPopup">
    <button type="button" class="btn btn-primary" id="applyBtn" hidden>Apply</button>
    <button type="button" class="btn btn-secondary" id="closeBtn" hidden>Close</button>
</div>


<div class="container-md mt-4 py-4 px-5">
    <style>
        body {
            background: #ffffff
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(30, 144, 255);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 15px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }

        .col-md-12 {
            margin-bottom: 20px;
            /* Menambahkan jarak vertikal 10px antara setiap lane */
        }

        .labels {
            display: inline-block;
            width: 100px;
            margin-right: 10px;
        }

        .labels {
            display: inline-block;
            width: 150px;
            margin-right: 20px;
        }

        .row {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .col-md-12 {
            border-bottom: 1px solid #ccc;
            padding: 5px 0;
        }

        .col-md-12:last-child {
            border-bottom: none;
        }

        .labels {
            display: inline-block;
            width: 200px;
            margin-right: 10px;
            /* Sesuaikan nilai margin-right untuk mengatur jarak */
        }
    </style>

    <div class="row">
        <div class="col-md-3 border-right">
            <!-- <h4 class="mb-3 mt-5">Biodata</h4> -->
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                    width="150px"
                    src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
                    class="font-weight-bold">albert junggler</span><span class="text-black-50"></span><span>
                </span></div>
        </div>
        <div class="col-md-4 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Biodata Siswa</h4>
                </div>

                <div class="col-md-12"><label class="labels">Nama Siswa</label> : <span>08123456789</span></div>
                <div class="col-md-12"><label class="labels">Jenis Kelamin</label> : <span>08123456789</span></div>
                <div class="col-md-12"><label class="labels">NISN</label> : <span>08123456789</span></div>
                <div class="col-md-12"><label class="labels">NIK</label> : <span>08123456789</span></div>
                <div class="col-md-12"><label class="labels">No akta Kelahiran</label> : <span>08123456789</span></div>
                <div class="col-md-12"><label class="labels">Alamat</label> : <span>Apt 4B</span></div>
                <div class="col-md-12"><label class="labels">agama</label> : <span>12345</span></div>
                <div class="col-md-12"><label class="labels">tempat lahir</label> : <span>California</span></div>
                <div class="col-md-12"><label class="labels">tanggal Lahir</label> : <span>Los Angeles</span></div>
                <div class="col-md-12"><label class="labels">NO hp</label> : <span>albert@gmail.com</span></div>
                <div class="col-md-12"><label class="labels">Email </label> : <span>08123456789</span></div>
                <div class="col-md-12"><label class="labels">Asal Sekolah</label> : <span>08123456789</span></div>

                <div class="col-md-12"><label class="labels">Jenis tinggal</label> : <span>08123456789</span></div>
                <div class="col-md-12"><label class="labels">anak ke- </label> : <span>08123456789</span></div>
                <div class="col-md-12"><label class="labels">Tinggi Badan</label> : <span></span>
                </div>
                <div class="col-md-12"><label class="labels">Berat Badan</label> : <span></span>
                </div>
                <div class="col-md-12"><label class="labels">Jumlah Saudara Kandung</label> : <span></span></div>
                <div class="col-md-12"><label class="labels">Golongan Darah</label> : <span></span></div>
                <div class="col-md-12"><label class="labels">Penerima KPS</label> : Tidak<span></span></div>
                <div class="col-md-12"><label class="labels">Statues Siswa</label> : <span>Jane Doe</span></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Data Keluarga</h4>
                </div>
                <h5>Data Ayah</h5>
                <div class="col-md-12"><label class="labels">Nama Ayah</label> : <span>John Doe</span></div>
                <div class="col-md-12"><label class="labels">Tempat Lahir ayah</label> : <span>Jane Doe</span></div>
                <div class="col-md-12"><label class="labels">Tanggal Lahir ayah</label> : <span>Jane Doe</span></div>
                <div class="col-md-12"><label class="labels">Nomor HP ayah </label> : <span>John Doe</span></div>
                <div class="col-md-12"><label class="labels">Agama Ayah</label> : <span>Jane Doe</span></div>
                <div class="col-md-12"><label class="labels">Pendidikan Terakhir Ayah</label> : <span>John Doe</span>
                </div>
                <div class="col-md-12"><label class="labels">Alamat Ayah</label> : <span>John Doe</span></div>
                <div class="col-md-12"><label class="labels">Pekerjaan Ayah</label> : <span>John Doe</span></div>
                <div class="col-md-12"><label class="labels">Gaji Ayah</label> : <span>Jane Doe</span></div>
                <h5>Data Ibu</h5>
                <div class="col-md-12"><label class="labels">Nama Ibu </label> : <span>John Doe</span></div>
                <div class="col-md-12"><label class="labels">Tempat Lahir Ibu</label> : <span>Jane Doe</span>
                </div>
                <div class="col-md-12"><label class="labels">Tanggal Lahir Ibu</label> : <span>Jane Doe</span>
                </div>
                <div class="col-md-12"><label class="labels">Nomor HP Ibu </label> : <span>John Doe</span></div>
                <div class="col-md-12"><label class="labels">Agama Ibu</label> : <span>Jane Doe</span></div>
                <div class="col-md-12"><label class="labels">Pendidikan Terakhir Ibu</label> : <span>JohnDoe</span>
                </div>
                <div class="col-md-12"><label class="labels">Alamat Ibu</label> : <span>John Doe</span></div>
                <div class="col-md-12"><label class="labels">Pekerjaan Ibu</label> : <span>John Doe</span></div>
                <div class="col-md-12"><label class="labels">Gaji Ibu</label> : <span>Jane Doe</span></div>
                <h5>Data wali</h5>
                <div class="col-md-12"><label class="labels">Nama Wali </label> : <span>John Doe</span></div>
                <div class="col-md-12"><label class="labels">Tempat Lahir wali</label> : <span>Jane Doe</span>
                </div>
                <div class="col-md-12"><label class="labels">Tanggal Lahir wali </label> : <span>Jane Doe</span>
                </div>
                <div class="col-md-12"><label class="labels">Nomor HP wali</label> : <span>John Doe</span></div>
                <div class="col-md-12"><label class="labels">Agama wali</label> : <span>Jane Doe</span></div>
                <div class="col-md-12"><label class="labels">Pendidikan Terakhir wali</label> : <span>John
                        Doe</span>
                </div>
                <div class="col-md-12"><label class="labels">Alamat wali</label> : <span>John Doe</span></div>
                <div class="col-md-12"><label class="labels">Pekerjaan wali</label> : <span>John Doe</span>
                </div>
                <div class="col-md-12"><label class="labels">Gaji wali</label> : <span>Jane Doe</span></div>
            </div>
        </div>
    </div>
</div>
@endsection