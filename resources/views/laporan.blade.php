@php
    $tempTK = [];
    $tempSD = [];
    $tempSMP = [];
    $KatPenghasilan = ['Ayah', 'Ibu','Wali-Murid'];
    $KatAgama = ['Laki-laki', 'Perempuan'];
@endphp

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

@extends('layout-yayasan.second')
@section('isi-content')

<div class="data-siswa py-5 " style="background: #244076;">
    <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
        <div class="card">
            <div class="card-header" style="background: #89a5dd;">
                <h2 class="card-title"> Form Laporan </h2>
            </div>
            <div class="col-md-12" style="background: #D9D9D9;">
                
                <form action="{{ route('laporanFilter', ['title' => 'Judul Laporan']) }}" method="post" style="margin-left: 18vw;" id="formContainer">
                    @csrf
                    <input type="hidden" name="title" value="Judul Laporan">
                    <table class="ms-5 mt-4">
                        <div class="btn-group">         
                            <input type="radio" class="btn-check" name="laporanType" id="agama" value="agama" />
                            <label class="btn btn-secondary" for="agama">Agama</label>
    
                            <input type="radio" class="btn-check" name="laporanType" id="jk" value="jk" />
                            <label class="btn btn-secondary" for="jk">Jenis Kelamin</label>
    
                            <input type="radio" class="btn-check" name="laporanType" id="penghasilan" value="penghasilan" />
                            <label class="btn btn-secondary" for="penghasilan">Penghasilan</label>
                          
                            <input type="radio" class="btn-check" name="laporanType" id="kps" value="kps" />
                            <label class="btn btn-secondary" for="kps">Kartu Pintar Sekolah</label>
        
                        </div>
                    </table>

                    <select id="tingkatan" name="tingkatan" onchange="updateNamaSekolahOptions()">
                        <option selected disabled> Tingkatan sekolah </option>
                        <option value="TK">TK</option>
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
                    
                    <script>
                        
                    </script>
                    

                    <select id="kelasTK" name="kelasTK" disabled>
                        <option selected disabled>TK</option>
                        <option value=" Kelas A">A</option>
                        <option value=" Kelas B">B</option>
                        <option value="">All</option>

                        <!-- Options for the class dropdown -->
                    </select>
                    <select id="kelasSD" name="kelasSD" disabled>
                        <option selected disabled>SD</option>
                        <option value=" Kelas 1">1</option>
                        <option value=" Kelas 2">2</option>
                        <option value=" Kelas 3">3</option>
                        <option value=" Kelas 4">4</option>
                        <option value=" Kelas 5">5</option>
                        <option value=" Kelas 6">6</option>
                        <option value="">All</option>
                        <!-- Options for the class dropdown -->
                    </select>
                    <select id="kelasSMP" name="kelasSMP" disabled>
                        <option selected disabled>SMP</option>
                        <option value=" Kelas 1">1</option>
                        <option value=" Kelas 2">2</option>
                        <option value=" Kelas 3">3</option>
                        <option value="">All</option>
                        <!-- Options for the class dropdown -->
                    </select>
            
                    <select id="kategori" name="kategori" disabled>
                        <option selected disabled>Kategori</option>  
                        @foreach ($KatPenghasilan as $index => $KP)
                        <option value="{{ $KP }}" class="option-kp">{{ $KP }}</option>
                        @endforeach
                        @foreach ($KatAgama as $index => $KA)
                        <option value="{{ $KA }}" class="option-ka">{{ $KA }}</option>
                        @endforeach
                    </select>
                    <script>
                        const kategoriDropdown = document.getElementById("kategori");
                        const laporanTypeRadios = document.querySelectorAll("input[name='laporanType']");
                    
                        laporanTypeRadios.forEach(radio => {
                            radio.addEventListener("change", function() {
                                kategoriDropdown.innerHTML = "<option selected disabled>Kategori</option>";
                                if (this.value === "agama") {
                                    @foreach ($KatAgama as $index => $KA)
                                        kategoriDropdown.innerHTML += `<option value="{{ $KA }}" class="option-ka">{{ $KA }}</option>`;
                                    @endforeach
                                } else if (this.value === "penghasilan") {
                                    @foreach ($KatPenghasilan as $index => $KP)
                                        kategoriDropdown.innerHTML += `<option value="{{ $KP }}" class="option-kp">{{ $KP }}</option>`;
                                    @endforeach
                                }
                                kategoriDropdown.removeAttribute("disabled");
                            });
                        });
                    </script>
        
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

                            <input type="radio" id="Choice6" name="detailKelas" value="all" />
                            <label for="Choice6">All</label>

                    </div>
        
                    <td>
                        <button type="submit" onclick="getValue()" class="btn btn-primary float-center mt-3">Tampil <i class="fa-solid fa-eye"></i></button>
                        <a href="{{ route('cetakLaporan',  ['title' => 'cetak Laporan'])}}" target="blank" class="btn btn-success float-center mt-3">Download <i class="fa-solid fa-download"></i></a>
                    </td>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<div class="data-siswa py-3 " style="background: #D9D9D9;">
    <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
        <table id="example" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    @if (request()->has('laporanType'))
                        <th>Agama</th>
                    @endif
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
                            @if (request()->has('laporanType'))
                                <th>Agama</th>
                            @endif
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
                    @if (request()->has('laporanType'))
                        <th>Agama</th>
                    @endif
                    <th>Nama Sekolah</th>
                    <th>Kelas</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- pop up -->
<div class="filter-popup" id="filterPopup">
    <button type="button" class="btn btn-primary" id="applyBtn" hidden>Apply</button>
    <button type="button" class="btn btn-secondary" id="closeBtn" hidden>Close</button>
</div>

<div class="data-siswa py-3 " style="background: #D9D9D9;">
    <div class="chart-container"
        style=" margin-left: 1%; margin-right:1%; background-color : #D9D9D9; ">
        <div></div>
        <canvas id="agamaChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mengambil data siswa dari PHP
        var dataSiswa = @json($data_siswa);

        // Menghitung jumlah siswa per agama
        var agamaCounts = {};
        dataSiswa.forEach(function(siswa) {
            var agama = siswa.Agama;
            agamaCounts[agama] = (agamaCounts[agama] || 0) + 1;
        });

        // Ambil elemen canvas untuk grafik
        var agamaChartCanvas = document.getElementById('agamaChart').getContext('2d');

        // Buat data dan konfigurasi grafik
        var agamaChart = new Chart(agamaChartCanvas, {
            type: 'bar',
            data: {
                labels: Object.keys(agamaCounts),
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: Object.values(agamaCounts),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(0, 255, 0, 0.2)',
                        'rgba(128, 128, 128, 0.2)',
                        'rgba(255, 0, 255, 0.2)',
                        'rgba(255, 255, 0, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(0, 255, 0, 1)',
                        'rgba(128, 128, 128, 1)',
                        'rgba(255, 0, 255, 1)',
                        'rgba(255, 255, 0, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

C

