@php
    $tempTK = [];
    $tempSD = [];
    $tempSMP = [];
    $laporanType = request('laporanType');
    
@endphp
@if (!is_null($data_siswa))
    @foreach ($sekolah as $item)
        @if (strpos($item->NAMASEKOLAH, 'TK') !== false)
            @php
                $tempTK[] = $item->NAMASEKOLAH;
            @endphp
        @elseif (strpos($item->NAMASEKOLAH, 'SD') !== false)
            @php
                $tempSD[] = $item->NAMASEKOLAH;
            @endphp
        @else
            @php
                $tempSMP[] = $item->NAMASEKOLAH;
            @endphp
        @endif
    @endforeach
@endif

@extends('layout-yayasan.second')


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
@stack('scripts')
@section('isi-content')
    <div class="ms-5 py-5">
        <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"> Form Laporan </h2>
                </div>
                <div class="col-md-12">
                    <form action="{{ route('laporanFilter') }}" method="post" style="margin-left:5%; margin-right:5%"
                        id="formContainer">
                        @csrf
                        <input type="hidden" name="title" value="Judul Laporan">
                        <table class="ms-5 mt-4">
                            <div class="btn-group">
                                <input type="radio" class="btn-check" name="laporanType" id="agama" value="agama" />
                                <label class="btn btn-secondary" for="agama">Agama</label>

                                <input type="radio" class="btn-check" name="laporanType" id="jk" value="jk" />
                                <label class="btn btn-secondary" for="jk">Jenis Kelamin</label>

                                <input type="radio" class="btn-check" name="laporanType" id="penghasilan"
                                    value="penghasilan" />
                                <label class="btn btn-secondary" for="penghasilan">Penghasilan</label>

                                <input type="radio" class="btn-check" name="laporanType" id="kps" value="kps" />
                                <label class="btn btn-secondary" for="kps">Kartu Pintar Sekolah</label>
                                <!-- baru -->
                                <input type="radio" class="btn-check" name="laporanType" id="zonasi" value="zonasi" />
                                <label class="btn btn-secondary" for="zonasi">Zonasi</label>

                                <input type="radio" class="btn-check" name="laporanType" id="jumlah_siswa"
                                    value="jumlah_siswa" />
                                <label class="btn btn-secondary" for="jumlah_siswa">Jumlah Siswa</label>
                            </div>
                        </table>
                        <!-- ini bedaa -->
                        <select id="tingkatan" name="tingkatan" onchange="updateNamaSekolahOptions()">
                            <option selected disabled> Tingkatan sekolah </option>
                            <option value="TK" id="tingkatan-tk">TK</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                        </select>

                        <select id="namaSekolah" name="namaSekolah" disabled>
                            <option selected disabled>Nama Sekolah</option>
                            <!-- Opsi nama sekolah TK -->
                            @foreach ($tempTK as $index => $namaTK)
                                <option value="{{ $namaTK }}" class="option-tk">{{ $namaTK }}</option>
                            @endforeach
                            <!-- Opsi nama sekolah SD -->
                            @foreach ($tempSD as $index => $namaSD)
                                <option value="{{ $namaSD }}" class="option-sd">{{ $namaSD }}</option>
                            @endforeach
                            <!-- Opsi nama sekolah SMP -->
                            @foreach ($tempSMP as $index => $namaSMP)
                                <option value="{{ $namaSMP }}" class="option-smp">{{ $namaSMP }}</option>
                            @endforeach
                        </select>


                        <select id="kelasTK" name="kelasTK" disabled>
                            <option selected disabled>TK</option>
                            <option value="Kelas A">A</option>
                            <option value="Kelas B">B</option>
                            <option value="all">all</option>

                            <!-- Options for the class dropdown -->
                        </select>
                        <select id="kelasSD" name="kelasSD" disabled>
                            <option selected disabled>SD</option>
                            <option value="Kelas 1">1</option>
                            <option value="Kelas 2">2</option>
                            <option value="Kelas 3">3</option>
                            <option value="Kelas 4">4</option>
                            <option value="Kelas 5">5</option>
                            <option value="Kelas 6">6</option>
                            <option value="all">all</option>


                            <!-- Options for the class dropdown -->
                        </select>
                        <select id="kelasSMP" name="kelasSMP" disabled>
                            <option selected disabled>SMP</option>
                            <option value="Kelas 7">7</option>
                            <option value="Kelas 8">8</option>
                            <option value="Kelas 9">9</option>
                            <option value="all">all</option>
                            <!-- Options for the class dropdown -->
                        </select>

                        <div class="col-mt-3">
                            <label for="">Spesifik kelas : </label>
                            <input type="radio" id="Choice1" name="detailKelas" value="A" />
                            <label for="Choice1">A</label>

                            <input type="radio" id="Choice2" name="detailKelas" value="B" />
                            <label for="Choice2">B</label>

                            <input type="radio" id="Choice3" name="detailKelas" value="C" />
                            <label for="Choice3">C</label>

                            <input type="radio" id="Choice4" name="detailKelas" value="D" />
                            <label for="tChoice4">D</label>

                            <input type="radio" id="Choice5" name="detailKelas" value="E" />
                            <label for="Choice5">E</label>
                            <!-- YANG BARU ALL  -->
                            <input type="radio" id="Choice5" name="detailKelas" value="semua" />
                            <label for="Choice5">All</label>
                        </div>


                        <td>
                            <button type="submit" id="submit" onclick="getValue()"
                                class="btn btn-primary float-center mt-3">Tampil
                                <i class="fa-solid fa-eye"></i></button>
                            {{-- <a href="{{ route('cetakLaporan', ['title' => 'cetak Laporan']) }}" target="blank" --}}
                            <a href="#" target="blank" class="btn btn-success float-center mt-3">Download <i
                                    class="fa-solid fa-download"></i></a>

                            <script>
                                $(document).ready(function() {
                                    $('form').submit(function(event) {
                                        var laporanType = $('[name="laporanType"]:checked').val();
                                        var tingkatan = $('[name="tingkatan"]').val();
                                        var namaSekolah = $('[name="namaSekolah"]').val();

                                        if (laporanType === 'zonasi' && tingkatan && !namaSekolah) {
                                            event.preventDefault();
                                            alert('Nama Sekolah Belum di isi silakan di isi !');
                                        }
                                    });
                                });
                            </script>
                        </td>

                    </form>
                </div>
            </div>
        </div>

        @if (!empty(count($data_siswa)))
            <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3">
                <div class="table-data" style="margin-left: 1%; margin-right: 1%;">
                    <table id="example" data-tampil class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Nama Sekolah</th>
                                <th>Kelas</th>
                                @if (request()->has('laporanType'))
                                    @if ($laporanType === 'jk')
                                    @elseif($laporanType === 'zonasi')
                                        <th>Jarak (km)</th>
                                    @elseif($laporanType === 'penghasilan')
                                        <th>Penghasilan Ayah</th>
                                        <th>Penghasilan Ibu</th>
                                        <th>Penghasilan Wali</th>
                                    @elseif($laporanType === 'agama')
                                        <th>Agama</th>
                                    @elseif ($laporanType === 'kps')
                                        <th>Layak PIP</th>
                                        <th>Alasan Layak PIP</th>
                                        <th>Penerima KPS</th>
                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            {{-- untuk menampilkan data --}}
                            @foreach ($data_siswa as $item)
                                <tr>
                                    <td>{{ $item->NISN }}</td>
                                    <td>{{ $item->Nama ?? $item->nama_siswa }}</td>
                                    <td>{{ $item->Tanggal_Lahir ?? $item->tanggal_lahir }}</td>
                                    <td>
                                        @if ($item->JK == 'L' || $item->gender == '1')
                                            Laki-Laki
                                        @elseif ($item->JK == 'P' || $item->gender == '2')
                                            Perempuan
                                        @endif
                                    </td>
                                    <td>{{ $item->sekolah->NAMASEKOLAH }}</td>
                                    <td>{{ $item->Rombel_Set_Ini }}</td>
                                    @if (request()->has('laporanType'))
                                        @if ($laporanType === 'zonasi')
                                            <td>{{ $item->Jarak_Rumah_ke_Sekolah }}</td>
                                        @elseif($laporanType === 'penghasilan')
                                            <td>{{ $item->Penghasilan_Ayah }}</td>
                                            <td>{{ $item->Penghasilan_Ibu }}</td>
                                            <td>{{ $item->Penghasilan_wali }}</td>
                                        @elseif($laporanType === 'agama')
                                            <td>{{ $item->Agama }}</td>
                                        @elseif ($laporanType === 'kps')
                                            <td>{{ $item->Layak_PIP }}</td>
                                            <td>{{ $item->Alasan_Layak_PIP }}</td>
                                            <td>{{ $item->Penerima_KPS }}</td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            @if (request()->has('laporanType'))
                @if ($laporanType === 'jk')
                    <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3">
                        <div class="text-left" style="margin-bottom: 15px; padding-left: 10px;">
                            @isset($jumlahLakiLaki)
                                <p1>Jumlah Laki-laki : {{ $jumlahLakiLaki }}<br></p1>
                            @endisset
                            @isset($jumlahPerempuan)
                                <p1>Jumlah Perempuan : {{ $jumlahPerempuan }}<br></p2>
                                @endisset
                                @isset($totalJL)
                                    <p1>Total Jumlah Laki-laki dan Perempuan : {{ $totalJL }}<br></p3>
                                    @endisset
                        </div>
                        <div>
                            <div class="chart-container"
                                style="width: 100%; max-width: 600px; margin: 0 auto; display: flex; justify-content: center; align-items: center;">
                                <canvas id="genderChart"></canvas>
                            </div>
                            <div class="text-center mt-1">
                                <!-- Tampilkan hasil data -->
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    var ctx = document.getElementById('genderChart').getContext('2d');
                                    var genderChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['Laki-laki', 'Perempuan'],
                                            datasets: [{
                                                label: 'Jumlah Siswa',
                                                data: [{{ $jumlahLakiLaki }}, {{ $jumlahPerempuan }}],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    ticks: {
                                                        stepSize: 1,
                                                        callback: function(value, index, values) {
                                                            if (Number.isInteger(value)) {
                                                                return value;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        @elseif ($laporanType === 'zonasi')
                            <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3">
                                @php
                                    $rataRataJarak = isset($rataRataJarak) ? $rataRataJarak : [];
                                @endphp
                                <!DOCTYPE html>
                                <html>

                                <head>
                                    <title> Data Siswa per Kelas dan Jarak</title>
                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                </head>

                                <body>
                                    <h1 class="px-3">Data Siswa per Kelas dan Jarak</h1>
                                    <div style="width: 100%; max-width: 500px; margin: auto;">
                                        <canvas id="laporan"></canvas>
                                    </div>
                                    <script>
                                        var ctx = document.getElementById('laporan').getContext('2d');
                                        var laporan = new Chart(ctx, {
                                            type: 'radar',
                                            data: {
                                                labels: {!! json_encode(array_keys($rataRataJarak)) !!},
                                                datasets: [{
                                                    label: 'Rata-rata Jarak',
                                                    data: {!! json_encode(array_values($rataRataJarak)) !!},
                                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                    borderColor: 'rgba(255, 99, 132, 1)',
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                scales: {
                                                    r: {
                                                        beginAtZero: true
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                </body>

                                </html>

                            </div>
                        @elseif ($laporanType === 'agama')
                            <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3 row">
                                <div class="chart-container col-md-6" id="agamaChartContainer"
                                    style="width: 100%; max-width: 600px; margin: 0 auto; ">
                                    <canvas id="agamaChart"></canvas>
                                </div>

                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    // Mengambil data siswa dari PHP
                                    var dataSiswa = @json($data_siswa);

                                    var agamaCounts = {
                                        Katholik: {
                                            L: 0,
                                            P: 0,
                                        },
                                        Islam: {
                                            L: 0,
                                            P: 0,
                                        },
                                        Kristen: {
                                            L: 0,
                                            P: 0,
                                        },
                                        Hindu: {
                                            L: 0,
                                            P: 0,
                                        },
                                        Budha: {
                                            L: 0,
                                            P: 0,
                                        },
                                        Konghucu: {
                                            L: 0,
                                            P: 0,
                                        },
                                    };
                                    if (typeof dataSiswa !== "undefined") {
                                        dataSiswa?.forEach(function(siswa) {
                                            var agama = siswa.Agama;
                                            var jk = siswa.JK;
                                            agamaCounts[agama][jk]++;
                                        });
                                    }

                                    // Ambil elemen canvas untuk grafik
                                    var agamaChartCanvas = document.getElementById("agamaChart")?.getContext("2d");

                                    // Buat data dan konfigurasi grafik
                                    if (agamaChartCanvas) {
                                        var agamaChart = new Chart(agamaChartCanvas, {
                                            type: "bar",
                                            data: {
                                                labels: Object.keys(agamaCounts),
                                                datasets: [{
                                                        label: "Laki-laki",
                                                        data: Object.values(agamaCounts).map((value) => value["L"]),
                                                        backgroundColor: "rgba(54, 162, 235, 0.2)",
                                                        borderColor: "rgba(54, 162, 235, 1)",
                                                        borderWidth: 1,
                                                    },
                                                    {
                                                        label: "Perempuan",
                                                        data: Object.values(agamaCounts).map((value) => value["P"]),
                                                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                                                        borderColor: "rgba(255, 99, 132, 1)",
                                                        borderWidth: 1,
                                                    },
                                                ],
                                            },
                                            options: {
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                    },
                                                },
                                            },
                                        });


                                    }
                                </script>

                                <div class=" table-data col-md-6"
                                    style="margin-left: 1%; margin-right:1%; display: flex; justify-content: center; align-items: center;">
                                    <table id="example" class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Jenis Kelamin</th>
                                                <th colspan="6">Agama</th>

                                            </tr>
                                            <tr>
                                                <th>Islam</th>
                                                <th>Kristen</th>
                                                <th>Katolik</th>
                                                <th>Hindu</th>
                                                <th>Budha</th>
                                                <th>Khonghucu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Baris untuk Perempuan -->
                                            <tr>
                                                <td>Perempuan</td>
                                                @if (isset($siswaCounts))
                                                    <td>{{ $siswaCounts->where('JK', 'P')->where('Agama', 'Islam')->sum('total') }}
                                                    </td>
                                                    <td>{{ $siswaCounts->where('JK', 'P')->where('Agama', 'Kristen')->sum('total') }}
                                                    </td>
                                                    <td>{{ $siswaCounts->where('JK', 'P')->where('Agama', 'Katholik')->sum('total') }}
                                                    </td>
                                                    <td>{{ $siswaCounts->where('JK', 'P')->where('Agama', 'Hindu')->sum('total') }}
                                                    </td>
                                                    <td>{{ $siswaCounts->where('JK', 'P')->where('Agama', 'Budha')->sum('total') }}
                                                    </td>
                                                    <td>{{ $siswaCounts->where('JK', 'P')->where('Agama', 'Khonghucu')->sum('total') }}
                                                    </td>
                                                @endif
                                            </tr>

                                            <!-- Baris untuk Laki-laki -->
                                            <tr>
                                                <td>Laki-laki</td>
                                                @if (isset($siswaCounts))
                                                    <td>{{ $siswaCounts->where('JK', 'L')->where('Agama', 'Islam')->sum('total') }}
                                                    </td>
                                                    <td>{{ $siswaCounts->where('JK', 'L')->where('Agama', 'Kristen')->sum('total') }}
                                                    </td>
                                                    <td>{{ $siswaCounts->where('JK', 'L')->where('Agama', 'Katholik')->sum('total') }}
                                                    </td>
                                                    <td>{{ $siswaCounts->where('JK', 'L')->where('Agama', 'Hindu')->sum('total') }}
                                                    </td>
                                                    <td>{{ $siswaCounts->where('JK', 'L')->where('Agama', 'Budha')->sum('total') }}
                                                    </td>
                                                    <td>{{ $siswaCounts->where('JK', 'L')->where('Agama', 'Khonghucu')->sum('total') }}
                                                    </td>
                                                @endif

                                            </tr>

                                            <!-- Baris untuk Total Agama -->
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                @if (isset($siswaCounts))
                                                    <td>{{ $siswaCounts->where('Agama', 'Islam')->sum('total') }}</td>
                                                    <td>{{ $siswaCounts->where('Agama', 'Kristen')->sum('total') }}</td>
                                                    <td>{{ $siswaCounts->where('Agama', 'Katholik')->sum('total') }}</td>
                                                    <td>{{ $siswaCounts->where('Agama', 'Hindu')->sum('total') }}</td>
                                                    <td>{{ $siswaCounts->where('Agama', 'Budha')->sum('total') }}</td>
                                                    <td>{{ $siswaCounts->where('Agama', 'Khonghucu')->sum('total') }}</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @elseif ($laporanType === 'kps')
                            <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3 row">
                                <div class="chart-container col-md-6" id="pipChartContainer"
                                    style="width: 100%; max-width: 400px;">
                                    <canvas id="pipChart"></canvas>
                                    <canvas id="agamaChart"></canvas>
                                </div>

                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    // Mengambil data siswa dari PHP
                                    var dataSiswa = @json($data_siswa);
                                    // Menghitung jumlah siswa
                                    agamaChartContainer = document.getElementById('agamaChart');
                                    agamaChartContainer.style.display = 'none';

                                    // Menghitung jumlah siswa
                                    var PIPCounts = {};
                                    if (typeof dataSiswa !== "undefined") {
                                        dataSiswa.forEach(function(siswa) {
                                            var pip = siswa.Layak_PIP;
                                            PIPCounts[pip] = (PIPCounts[pip] || 0) + 1;
                                        });
                                    }

                                    // Ambil elemen canvas untuk grafik
                                    var pipChartCanvas = document.getElementById("pipChart")?.getContext("2d");

                                    // Buat data dan konfigurasi grafik
                                    if (pipChartCanvas) {
                                        var pipChart = new Chart(pipChartCanvas, {
                                            type: "pie",
                                            data: {
                                                labels: Object.keys(PIPCounts),
                                                datasets: [{
                                                    label: "Jumlah Siswa",
                                                    data: Object.values(PIPCounts),
                                                    backgroundColor: [
                                                        "rgba(255, 99, 132, 0.2)",
                                                        "rgba(54, 162, 235, 0.2)",
                                                    ],
                                                    borderColor: [
                                                        "rgba(255, 99, 132, 1)",
                                                        "rgba(54, 162, 235, 1)",
                                                    ],
                                                    borderWidth: 1,
                                                }, ],
                                            },
                                        });
                                    }
                                </script>
                                <div class="col-md-1"></div>
                                @if (request()->has('laporanType'))
                                    @if ($laporanType === 'kps')
                                        <div class=" table-data col-md-6"
                                            style="margin-left: 1%; margin-right:1%; display: flex; justify-content: center; align-items: center;">
                                            <table id="exampley" class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2"></th>
                                                        <th colspan="2">Layak PIP</th>

                                                    </tr>
                                                    <tr>
                                                        <th>Ya</th>
                                                        <th>Tidak</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td>Jumlah</td>
                                                        @if (isset($layakPIPCounts))
                                                            <td>
                                                                {{ $layakPIPCounts->where('Layak_PIP', 'Ya')->sum('total') }}
                                                            </td>
                                                            <td>
                                                                {{ $layakPIPCounts->where('Layak_PIP', 'Tidak')->sum('total') }}
                                                            </td>
                                                        @endif

                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    @endif
                                @endif
                            </div>
                        @elseif ($laporanType === 'penghasilan')
                            <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3">
                                <!-- Visualisasi chart gender -->
                                <div class="chart-container bg-dark"
                                    style="width: 100%; max-width: 600px; margin: 0 auto; display: flex; justify-content: center; align-items: center;">
                                </div>
                                <div class="row">
                                    <div class="col-12 p-5">
                                        <div>
                                            <canvas id="penghasilanChart" width="100%" height="40"></canvas>
                                        </div>
                                        <div class="mt-5">
                                            <table id="table-ket" class="table table-bordered">
                                                <thead>
                                                    <tr class="bg-warning">
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="ket-tr-ayah">
                                                    </tr>
                                                    <tr class="ket-tr-ibu">
                                                    </tr>
                                                    <tr class="ket-tr-wali">
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>



                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    // Mengambil data siswa dari PHP
                                    var dataSiswa = @json($data_siswa);

                                    // Menghitung jumlah siswa per range penghasilan
                                    var penghasilanCountsAyah = {
                                        'Tidak Berpenghasilan': 0,
                                        'Kurang dari Rp. 500,000': 0,
                                        'Rp. 500,000 - Rp. 999,999': 0,
                                        'Rp. 1,000,000 - Rp. 1,999,999': 0,
                                        'Rp. 2,000,000 - Rp. 4,999,999': 0,
                                        'Rp. 5,000,000 - Rp. 20,000,000': 0
                                    };

                                    var penghasilanCountsIbu = {
                                        'Tidak Berpenghasilan': 0,
                                        'Kurang dari Rp. 500,000': 0,
                                        'Rp. 500,000 - Rp. 999,999': 0,
                                        'Rp. 1,000,000 - Rp. 1,999,999': 0,
                                        'Rp. 2,000,000 - Rp. 4,999,999': 0,
                                        'Rp. 5,000,000 - Rp. 20,000,000': 0
                                    };

                                    var penghasilanCountsWali = {
                                        'Tidak Berpenghasilan': 0,
                                        'Kurang dari Rp. 500,000': 0,
                                        'Rp. 500,000 - Rp. 999,999': 0,
                                        'Rp. 1,000,000 - Rp. 1,999,999': 0,
                                        'Rp. 2,000,000 - Rp. 4,999,999': 0,
                                        'Rp. 5,000,000 - Rp. 20,000,000': 0
                                    };


                                    dataSiswa.forEach(function(siswa) {
                                        var penghasilanAyah = siswa.Penghasilan_Ayah;
                                        var penghasilanIbu = siswa.Penghasilan_Ibu;
                                        var penghasilanWali = siswa.Penghasilan_wali;


                                        // Menggunakan penghasilan ayah
                                        penghasilanCountsAyah[penghasilanAyah]++;

                                        // // Menggunakan penghasilan ibu
                                        penghasilanCountsIbu[penghasilanIbu]++;

                                        // // Menggunakan penghasilan wali
                                        penghasilanCountsWali[penghasilanWali]++;
                                    });


                                    // Ambil elemen canvas untuk grafik
                                    var penghasilanChartCanvas = document.getElementById('penghasilanChart').getContext('2d');

                                    // Buat data dan konfigurasi grafik
                                    var penghasilanChart = new Chart(penghasilanChartCanvas, {
                                        type: 'bar',
                                        data: {
                                            labels: Object.keys

                                            (penghasilanCountsAyah),
                                            datasets: [{
                                                    label: 'Penghasilan Ayah',
                                                    data: Object.values(penghasilanCountsAyah),
                                                    backgroundColor: 'rgba(153,153,255, 1)', // Warna ungu solid
                                                    borderColor: 'rgba(153, 102, 255, 1)', // Warna ungu solid
                                                    borderWidth: 1,
                                                },
                                                {
                                                    label: 'Penghasilan Ibu',
                                                    data: Object.values(penghasilanCountsIbu),
                                                    backgroundColor: 'rgba(255,153,153, 1)',
                                                    borderColor: 'rgba(255, 99, 132, 1)',
                                                    borderWidth: 1
                                                },
                                                {
                                                    label: 'Penghasilan Wali',
                                                    data: Object.values(penghasilanCountsWali),
                                                    backgroundColor: 'rgba(75, 192, 192, 1)',
                                                    borderColor: 'rgba(75, 192, 192, 1)',
                                                    borderWidth: 1
                                                }
                                            ]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });

                                    var phsAyah = Object.entries(penghasilanCountsAyah);
                                    var phsIbu = Object.entries(penghasilanCountsIbu);
                                    var phsWali = Object.entries(penghasilanCountsWali);


                                    var thead = "<th>Penghasilan</th>";
                                    var trAyah = "<td>Ayah</td>";
                                    var trIbu = "<td>Ibu</td>";
                                    var trWali = "<td>Wali</td>";
                                    for (let i = 0; i < phsIbu.length; i++) {
                                        thead += "<th>" + phsIbu[i][0] + "</th>";
                                        trAyah += "<td>" + phsAyah[i][1] + "</td>";
                                        trIbu += "<td>" + phsIbu[i][1] + "</td>";
                                        trWali += "<td>" + phsWali[i][1] + "</td>";
                                    }

                                    $("#table-ket thead tr").html(thead);
                                    $("#table-ket tbody .ket-tr-ayah").html(trAyah);
                                    $("#table-ket tbody .ket-tr-ibu").html(trIbu);
                                    $("#table-ket tbody .ket-tr-wali").html(trWali);
                                </script>

                                <div>
                                    <p style="texttext-align: left;  margin-left: 3%; margin-right:3%;">Rata-rata
                                        Penghasilan Ayah: <span id="rataRataAyah"></span></p>
                                    <p style="text-align: left;   margin-left: 3%; margin-right:3%;">Rata-rata
                                        Penghasilan Ibu: <span id="rataRataIbu"></span></p>
                                    <p style="text-align: left;   margin-left: 3%; margin-right:3%;">Rata-rata
                                        Penghasilan Wali: <span id="rataRataWali"></span></p>
                                </div>
                            </div>


                            <script>
                                var dataSiswa = @json($data_siswa);
                                // Deklarasikan variabel untuk menghitung total penghasilan
                                var penghasilanCountsAyah = {
                                    'Tidak Berpenghasilan': 0,
                                    'Kurang dari Rp. 500,000': 0,
                                    'Rp. 500,000 - Rp. 999,999': 0,
                                    'Rp. 1,000,000 - Rp. 1,999,999': 0,
                                    'Rp. 2,000,000 - Rp. 4,999,999': 0,
                                    'Rp. 5,000,000 - Rp. 20,000,000': 0
                                };

                                var penghasilanCountsIbu = {
                                    'Tidak Berpenghasilan': 0,
                                    'Kurang dari Rp. 500,000': 0,
                                    'Rp. 500,000 - Rp. 999,999': 0,
                                    'Rp. 1,000,000 - Rp. 1,999,999': 0,
                                    'Rp. 2,000,000 - Rp. 4,999,999': 0,
                                    'Rp. 5,000,000 - Rp. 20,000,000': 0
                                };

                                var penghasilanCountsWali = {
                                    'Tidak Berpenghasilan': 0,
                                    'Kurang dari Rp. 500,000': 0,
                                    'Rp. 500,000 - Rp. 999,999': 0,
                                    'Rp. 1,000,000 - Rp. 1,999,999': 0,
                                    'Rp. 2,000,000 - Rp. 4,999,999': 0,
                                    'Rp. 5,000,000 - Rp. 20,000,000': 0
                                };

                                // Inisialisasi objek untuk menyimpan daftar siswa per kategori
                                var siswaPerKategoriAyah = {
                                    'Tidak Berpenghasilan': 0,
                                    'Kurang dari Rp. 500,000': 0,
                                    'Rp. 500,000 - Rp. 999,999': 0,
                                    'Rp. 1,000,000 - Rp. 1,999,999': 0,
                                    'Rp. 2,000,000 - Rp. 4,999,999': 0,
                                    'Rp. 5,000,000 - Rp. 20,000,000': 0
                                };

                                var siswaPerKategoriIbu = {
                                    'Tidak Berpenghasilan': 0,
                                    'Kurang dari Rp. 500,000': 0,
                                    'Rp. 500,000 - Rp. 999,999': 0,
                                    'Rp. 1,000,000 - Rp. 1,999,999': 0,
                                    'Rp. 2,000,000 - Rp. 4,999,999': 0,
                                    'Rp. 5,000,000 - Rp. 20,000,000': 0
                                };

                                var siswaPerKategoriWali = {
                                    'Tidak Berpenghasilan': 0,
                                    'Kurang dari Rp. 500,000': 0,
                                    'Rp. 500,000 - Rp. 999,999': 0,
                                    'Rp. 1,000,000 - Rp. 1,999,999': 0,
                                    'Rp. 2,000,000 - Rp. 4,999,999': 0,
                                    'Rp. 5,000,000 - Rp. 20,000,000': 0
                                };
                                var totalPenghasilanAyah = 0;
                                var totalPenghasilanIbu = 0;
                                var totalPenghasilanWali = 0;
                                var jumlahDataSiswa = dataSiswa.length;

                                dataSiswa.forEach(function(siswa) {
                                    var namaSiswa = siswa.Nama;
                                    var penghasilanAyah = siswa.Penghasilan_Ayah;
                                    var penghasilanIbu = siswa.Penghasilan_Ibu;
                                    var penghasilanWali = siswa.Penghasilan_wali;

                                    // Menggunakan penghasilan ayah
                                    penghasilanCountsAyah[penghasilanAyah]++;

                                    // // Menggunakan penghasilan ibu
                                    penghasilanCountsIbu[penghasilanIbu]++;

                                    // // Menggunakan penghasilan wali
                                    penghasilanCountsWali[penghasilanWali]++;

                                });



                                dataSiswa.forEach(function(siswa) {
                                    var penghasilanAyah = siswa.Penghasilan_Ayah;
                                    var penghasilanIbu = siswa.Penghasilan_Ibu;
                                    var penghasilanWali = siswa.Penghasilan_wali;

                                    var estimasiAyah = estimasiNilaiTengah(penghasilanAyah);
                                    var estimasiIbu = estimasiNilaiTengah(penghasilanIbu);
                                    var estimasiWali = estimasiNilaiTengah(penghasilanWali);

                                    totalPenghasilanAyah += estimasiAyah;
                                    totalPenghasilanIbu += estimasiIbu;
                                    totalPenghasilanWali += estimasiWali;

                                });

                                function estimasiNilaiTengah(range) {
                                    var matches = range?.match(/(?:\d|,)+/g);
                                    if (matches && matches.length === 2) {
                                        var lower = parseFloat(matches[0].replace(/,/g, ""));
                                        var upper = parseFloat(matches[1].replace(/,/g, ""));
                                        return (lower + upper) / 2;
                                    }
                                    return 0; // Default value if unable to estimate
                                }

                                var rataRataPenghasilanAyah = totalPenghasilanAyah / jumlahDataSiswa;
                                var rataRataPenghasilanIbu = totalPenghasilanIbu / jumlahDataSiswa;
                                var rataRataPenghasilanWali = totalPenghasilanWali / jumlahDataSiswa;

                                console.log('rataRataPenghasilanAyah:', rataRataPenghasilanAyah);
                                console.log('rataRataPenghasilanIbu:', rataRataPenghasilanIbu);
                                console.log('rataRataPenghasilanWali:', rataRataPenghasilanWali);

                                // Format dan tampilkan rata-rata dalam mata uang Rupiah
                                var formatter = new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                });
                                document.getElementById('rataRataAyah').textContent = formatter.format(rataRataPenghasilanAyah);
                                document.getElementById('rataRataIbu').textContent = formatter.format(rataRataPenghasilanIbu);
                                document.getElementById('rataRataWali').textContent = formatter.format(rataRataPenghasilanWali);
                            </script>
                @endif

                <script>
                    $(document).ready(function() {
                        // hide sekolah susuai tingkatan yg dipilih
                        $("#tingkatan").change(function() {
                            var tingkatan = $(this).val();
                            $(".option-tk").addClass("d-none");
                            $(".option-sd").addClass("d-none");
                            $(".option-smp").addClass("d-none");

                            if (tingkatan == "TK") {
                                $(".option-tk").removeClass("d-none");

                            } else if (tingkatan == "SD") {
                                $(".option-sd").removeClass("d-none");

                            } else if (tingkatan == "SMP") {
                                $(".option-smp").removeClass("d-none");
                            }

                        })

                        // submit filter
                        $("#filterButton").click(function() {
                            $("#formContainer").submit()
                        })
                    })
                </script>
            @endif
        @endif

        {{-- @if (empty(count($data_siswatk)) && empty(count($data_siswa)))
            <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3">
            <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
                <p class="text-danger text-center h2 fw-bold">DATA TIDAK DITEMUKAN <br> SILAHKAN COBA LAGI</p> 
            </div>
        </div>
        @endif --}}

        @if (request()->has('laporanType'))
            @if ($laporanType === 'agama')
                @if (!empty(count($data_siswatk)))
                    <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3" id="datasiswatk">
                        <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
                            <table id="example" data-tampil class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Agama</th>
                                        <th>Nama Sekolah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_siswatk as $item)
                                        <tr>
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
                                            <td>
                                                @if ($item->agama == '1')
                                                    Islam
                                                @elseif ($item->agama == '2')
                                                    Kristen
                                                @elseif ($item->agama == '3')
                                                    Katolik
                                                @elseif ($item->agama == '4')
                                                    Hindu
                                                @elseif ($item->agama == '5')
                                                    Budha
                                                @elseif ($item->agama == '6')
                                                    Khonghucu
                                                @endif
                                            </td>
                                            <td>{{ $item->sekolah->NAMASEKOLAH }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3 row">
                        <div class="chart-container col-md-6" id="agamaChartContainer"
                            style="width: 100%; max-width: 600px; margin: 0 auto; ">
                            <canvas id="agamaCharttk"></canvas>
                        </div>


                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <script>
                            var dataSiswatk = @json($data_siswatk);
                            var agamaCountss = {
                                3: {
                                    1: 0,
                                    2: 0,
                                },
                                1: {
                                    1: 0,
                                    2: 0,
                                },
                                2: {
                                    1: 0,
                                    2: 0,
                                },
                                4: {
                                    1: 0,
                                    2: 0,
                                },
                                5: {
                                    1: 0,
                                    2: 0,
                                },
                                6: {
                                    1: 0,
                                    2: 0,
                                },
                            };

                            // Objek untuk menghubungkan nilai dengan nama agama
                            var namaAgama = {
                                1: "Islam",
                                2: "Kristen",
                                3: "Katolik",
                                4: "Hindu",
                                5: "Budha",
                                6: "Khonghucu",
                            };

                            if (typeof dataSiswatk !== "undefined") {
                                dataSiswatk?.forEach(function(tk_siswa) {
                                    var tkagama = tk_siswa.agama;
                                    var tkjk = tk_siswa.gender;
                                    agamaCountss[tkagama][tkjk]++;
                                });
                            }

                            // Ambil elemen canvas untuk grafik
                            var agamaChartCanvass = document
                                .getElementById("agamaCharttk")
                                ?.getContext("2d");
                            // Buat data dan konfigurasi grafik
                            if (agamaChartCanvass) {
                                var agamaCharttk = new Chart(agamaChartCanvass, {
                                    type: "bar",
                                    data: {
                                        labels: Object.keys(namaAgama).map((value) => namaAgama[value]),
                                        datasets: [{
                                                label: "Laki-laki",
                                                data: Object.values(agamaCountss).map(
                                                    (value) => value["1"]
                                                ),
                                                backgroundColor: "rgba(54, 162, 235, 0.2)",
                                                borderColor: "rgba(54, 162, 235, 1)",
                                                borderWidth: 1,
                                            },
                                            {
                                                label: "Perempuan",
                                                data: Object.values(agamaCountss).map(
                                                    (value) => value["2"]
                                                ),
                                                backgroundColor: "rgba(255, 99, 132, 0.2)",
                                                borderColor: "rgba(255, 99, 132, 1)",
                                                borderWidth: 1,
                                            },
                                        ],
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                            },
                                        },
                                    },
                                });
                            }
                        </script>

                        @if (request()->has('laporanType'))
                            @if ($laporanType === 'agama')
                                <div class=" table-data col-md-6"
                                    style="margin-left: 1%; margin-right:1%; display: flex; justify-content: center; align-items: center;">
                                    <table id="example" class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Jenis Kelamin</th>
                                                <th colspan="6">Agama</th>

                                            </tr>
                                            <tr>
                                                <th>Islam</th>
                                                <th>Kristen</th>
                                                <th>Katolik</th>
                                                <th>Hindu</th>
                                                <th>Budha</th>
                                                <th>Khonghucu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Baris untuk Perempuan -->
                                            <tr>
                                                <td>Perempuan</td>
                                                <td>{{ $siswaCountstk->where('gender', '2')->where('agama', '1')->sum('total') }}
                                                </td>
                                                <td>{{ $siswaCountstk->where('gender', '2')->where('agama', '2')->sum('total') }}
                                                </td>
                                                <td>{{ $siswaCountstk->where('gender', '2')->where('agama', '3')->sum('total') }}
                                                </td>
                                                <td>{{ $siswaCountstk->where('gender', '2')->where('agama', '4')->sum('total') }}
                                                </td>
                                                <td>{{ $siswaCountstk->where('gender', '2')->where('agama', '5')->sum('total') }}
                                                </td>
                                                <td>{{ $siswaCountstk->where('gender', '2')->where('agama', '6')->sum('total') }}
                                                </td>

                                            </tr>

                                            <!-- Baris untuk Laki-laki -->
                                            <tr>
                                                <td>Laki-laki</td>
                                                <td>{{ $siswaCountstk->where('gender', '1')->where('agama', '1')->sum('total') }}
                                                </td>
                                                <td>{{ $siswaCountstk->where('gender', '1')->where('agama', '2')->sum('total') }}
                                                </td>
                                                <td>{{ $siswaCountstk->where('gender', '1')->where('agama', '3')->sum('total') }}
                                                </td>
                                                <td>{{ $siswaCountstk->where('gender', '1')->where('agama', '4')->sum('total') }}
                                                </td>
                                                <td>{{ $siswaCountstk->where('gender', '1')->where('agama', '5')->sum('total') }}
                                                </td>
                                                <td>{{ $siswaCountstk->where('gender', '1')->where('agama', '6')->sum('total') }}
                                                </td>
                                            </tr>

                                            <!-- Baris untuk Total Agama -->
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td>{{ $siswaCountstk->where('agama', '1')->sum('total') }}</td>
                                                <td>{{ $siswaCountstk->where('agama', '2')->sum('total') }}</td>
                                                <td>{{ $siswaCountstk->where('agama', '3')->sum('total') }}</td>
                                                <td>{{ $siswaCountstk->where('agama', '4')->sum('total') }}</td>
                                                <td>{{ $siswaCountstk->where('agama', '5')->sum('total') }}</td>
                                                <td>{{ $siswaCountstk->where('agama', '6')->sum('total') }}</td>

                                            </tr>
                                        </tbody>


                                    </table>
                                </div>
                    </div>
                @endif
            @endif
        @endif
        @endif
        @endif

        @if (request()->has('laporanType'))
            @if ($laporanType === 'jk')
                @if (!empty(count($data_siswatk)))
                    <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3 " id="datasiswatk">
                        <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
                            <table id="example" data-tampil class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Nama Sekolah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_siswatk as $item)
                                        <tr>
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
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if (request()->has('laporanType'))
                        @if ($laporanType === 'jk')
                            <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3">
                                <div class="text-left" style="margin-bottom: 15px; padding-left: 10px;">
                                    @isset($jumlahLakiLaki)
                                        <p1>Jumlah Laki-laki : {{ $jumlahLakiLaki }}<br></p1>
                                    @endisset
                                    @isset($jumlahPerempuan)
                                        <p1>Jumlah Perempuan : {{ $jumlahPerempuan }}<br></p2>
                                        @endisset
                                        @isset($totalJL)
                                            <p1>Total Jumlah Laki-laki dan Perempuan : {{ $totalJL }}<br></p3>
                                            @endisset
                                </div>
                                <div>
                                    <div class="chart-container"
                                        style="width: 100%; max-width: 600px; margin: 0 auto; display: flex; justify-content: center; align-items: center;">
                                        <canvas id="genderChart"></canvas>
                                    </div>
                                    <div class="text-center mt-1">
                                        <!-- Tampilkan hasil data -->
                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                        <script>
                                            var ctx = document.getElementById('genderChart').getContext('2d');
                                            var genderChart = new Chart(ctx, {
                                                type: 'bar',
                                                data: {
                                                    labels: ['Jumlah Laki-Laki dan Perempuan'],
                                                    datasets: [{
                                                        label: 'Laki-laki', // Label dataset Laki-laki
                                                        data: [{{ $jumlahLakiLaki }}],
                                                        backgroundColor: 'rgb(135, 206, 250)', // Warna biru terang
                                                        borderColor: 'rgb(70, 130, 180)', // Warna garis biru terang
                                                        borderWidth: 1
                                                    }, {
                                                        label: 'Perempuan', // Label dataset Perempuan
                                                        data: [{{ $jumlahPerempuan }}],
                                                        backgroundColor: 'rgb(255, 99, 132)', // Warna merah terang
                                                        borderColor: 'rgb(178, 34, 34)', // Warna garis merah terang
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true,
                                                            ticks: {
                                                                stepSize: 1,
                                                                callback: function(value, index, values) {
                                                                    if (Number.isInteger(value)) {
                                                                        return value;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>
                        @endif
                    @endif

                @endif
            @endif
        @endif

        @if (request()->has('laporanType'))
            @if ($laporanType === 'jumlah_siswa')
                @if (!empty(count($data_siswa_arsip)))
                    <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3">
                        <div class="table-data" style="margin-left: 1%; margin-right: 1%;">
                            <h2>Tabel Arsip siswa</h2>
                            <table id="example" data-tampil class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Nama Sekolah</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_siswa_arsip as $item)
                                        <tr>
                                            <td>{{ $item->NISN }}</td>
                                            <td>{{ $item->Nama ?? $item->nama_siswa }}</td>
                                            <td>{{ $item->Tanggal_Lahir ?? $item->tanggal_lahir }}</td>
                                            <td>
                                                @if ($item->JK == 'L' || $item->gender == '1')
                                                    Laki-Laki
                                                @elseif ($item->JK == 'P' || $item->gender == '2')
                                                    Perempuan
                                                @endif
                                            </td>
                                            <td>{{ $item->sekolah->NAMASEKOLAH }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endif
        @endif

        @if (request()->has('laporanType'))
            @if ($laporanType === 'jumlah_siswa')
                @if (!empty(count($data_siswa_arsipTK)))
                    <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3">
                        <div class="table-data" style="margin-left: 1%; margin-right: 1%;">
                            <table id="example" data-tampil class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Nama Sekolah</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_siswa_arsipTK as $item)
                                        <tr>
                                            <td>{{ $item->NISN }}</td>
                                            <td>{{ $item->Nama ?? $item->nama_siswa }}</td>
                                            <td>{{ $item->Tanggal_Lahir ?? $item->tanggal_lahir }}</td>
                                            <td>
                                                @if ($item->JK == 'L' || $item->gender == '1')
                                                    Laki-Laki
                                                @elseif ($item->JK == 'P' || $item->gender == '2')
                                                    Perempuan
                                                @endif
                                            </td>
                                            <td>{{ $item->sekolah->NAMASEKOLAH }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endif
        @endif

        @if (request()->has('laporanType'))
            @if ($laporanType === 'jumlah_siswa')
                <div class="ms-3 me-3 rounded-4 py-3 bg-white mt-3 row">
                    <div class="chart-container col-md-6" id="agamaChartContainer"
                        style="width: 100%; max-width: 600px; margin: 0 auto; ">
                        <canvas id="laporan"></canvas>
                    </div>


                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        var ctx = document.getElementById('laporan').getContext('2d');
                        var laporan = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: {!! json_encode(array_keys($combined_data)) !!},
                                datasets: [{
                                        label: 'Arship',
                                        data: {!! json_encode(array_column($combined_data, 'arship')) !!},
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'ArshipTk',
                                        data: {!! json_encode(array_column($combined_data, 'tkk_arsip')) !!},
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }

                                }
                            }
                        });
                    </script>
            @endif
        @endif

        <!-- pop up -->
        <div class="filter-popup" id="filterPopup">
            <button type="button" class="btn btn-primary" id="applyBtn" hidden>Apply</button>
            <button type="button" class="btn btn-secondary" id="closeBtn" hidden>Close</button>
        </div>

        <script src="{{ asset('/js/laporan.js') }}"></script>
        @yield('scripts')

    @endsection
