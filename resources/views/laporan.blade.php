@php
    $tempTK = [];
    $tempSD = [];
    $tempSMP = [];
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

<div class="data-siswa py-5 ">
    <div class=" table-data" style="margin-left: 1%; margin-right:1%;">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"> Form Laporan </h2>
            </div>
            <div class="col-md-12">
                
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

                    <select id="tingkatan" name="tingkatan" disabled>
                        <option selected disabled> Tingkatan sekolah </option>
                        <option value="TK">TK</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                    </select>
            
                    <select id="namaSekolah" name="namaSekolah" disabled>
                        <option selected disabled>Nama Sekolah</option>
                        
                        @foreach ($tempTK as $index => $namaTK)
                        <option value="{{ $namaTK }}">{{ $namaTK }}</option>
                        @endforeach
                    
                        @foreach ($tempSD as $index => $namaSD)
                        <option value="{{ $namaSD }}">{{ $namaSD }}</option>
                        @endforeach
                    
                        @foreach ($tempSMP as $index => $namaSMP)
                        <option value="{{ $namaSMP }}">{{ $namaSMP }}</option>
                        @endforeach
                    
                    </select>

                    <select id="kelasTK" name="kelasTK" disabled>
                        <option selected disabled>TK</option>
                        <option value="TK kelas A">A</option>
                        <option value="TK kelas B">B</option>
                        <!-- Options for the class dropdown -->
                    </select>
                    <select id="kelasSD" name="kelasSD" disabled>
                        <option selected disabled>SD</option>
                        <option value="SD kelas 1">1</option>
                        <option value="SD kelas 2">2</option>
                        <option value="SD kelas 3">3</option>
                        <option value="SD kelas 4">4</option>
                        <option value="SD kelas 5">5</option>
                        <option value="SD kelas 6">6</option>
                        <!-- Options for the class dropdown -->
                    </select>
                    <select id="kelasSMP" name="kelasSMP" disabled>
                        <option selected disabled>SMP</option>
                        <option value="SMP kelas 1">1</option>
                        <option value="SMP kelas 2">2</option>
                        <option value="SMP kelas 3">3</option>
                        <!-- Options for the class dropdown -->
                    </select>
            
                    <select id="kategoriPenghasilan" name="kategoriPenghasilan" disabled>
                        <option selected >Kategori</option>  
                        <option value="Ayah">Ayah</option>
                        <option value="Ibu">Ibu</option>
                        <option value="Wali Murid">Wali Murid</option>
                    </select>
        
                    <div class="col-mt-3">
                        <label for="">Spesifik kelas : </label>
                            <input type="radio" id="tChoice1" name="detailKelas" value="A" />
                            <label for="Choice1">A</label>
                      
                            <input type="radio" id="Choice2" name="detailKelas" value="B" />
                            <label for="Choice2">B</label>
                      
                            <input type="radio" id="Choice3" name="detaiKelas" value="C" />
                            <label for="Choice3">C</label>    

                            <input type="radio" id="Choice4" name="detailKelas" value="D" />
                            <label for="tChoice4">D</label>    

                            <input type="radio" id="Choice5" name="detaiKelas" value="E" />
                            <label for="Choice5">E</label>    
                    </div>
        
                    <td>
                        <button type="submit" onclick="getValue()" class="btn btn-primary float-center mt-3">Tampil <i class="fa-solid fa-eye"></i></button>
                        <a href="{{ route('cetakLaporan',  ['title' => 'cetak Laporan'])}}" target="blank" class="btn btn-success float-center mt-3">Download <i class="fa-solid fa-download"></i></a>
                    </td>
                    
                </form>


        
                <script>
                    // Get the form container element
                    const formContainer = document.getElementById("formContainer");
                
                    // Get the radio buttons for Penghasilan and Agama
                    const radioPenghasilan = document.getElementById("penghasilan");
                    const radioAgama = document.getElementById("agama");
                    const radioKps = document.getElementById("kps");
                    const radioJk = document.getElementById('jk')
                
                    // Function to disable all dropdowns
                    function disableAllDropdowns() {
                        const dropdowns = formContainer.querySelectorAll('select');
                        dropdowns.forEach(dropdown => {
                            dropdown.disabled = true;
                        });
                    }
                
                    // Function to enable specific dropdowns
                    function enableDropdowns() {
                        const selectedRadio = document.querySelector('input[name="laporanType"]:checked');
                        if (selectedRadio.id === 'penghasilan') {
                            // Enable the desired dropdowns
                            document.getElementById('tingkatan').disabled = false;
                            document.getElementById('namaSekolah').disabled = false;
                            document.getElementById('kategoriPenghasilan').disabled = false;
                            // Add other dropdowns here that you want to enable
                        } else if (selectedRadio.id === 'agama') {
                            // Enable other dropdowns based on Agama selection, if necessary
                            document.getElementById('tingkatan').disabled = false;
                            document.getElementById('namaSekolah').disabled = false;
                            document.getElementById('kategoriPenghasilan').disabled = true;
                        } else if (selectedRadio.id === 'kps'){
                            document.getElementById('tingkatan').disabled = false;
                            document.getElementById('namaSekolah').disabled = false;
                            document.getElementById('kategoriPenghasilan').disabled = true;
                        } else if (selectedRadio.id === 'jk'){
                            document.getElementById('tingkatan').disabled = false;
                            document.getElementById('namaSekolah').disabled = false;
                            document.getElementById('kategoriPenghasilan').disabled = true;
                        }
                    }
                    // Function to disable "Spesifik kelas" radio buttons
                    function disableSpesifikKelas() {
                    const spesifikKelasRadios = formContainer.querySelectorAll('input[name="detaiKelas"]');
                    spesifikKelasRadios.forEach(radio => {
                        radio.disabled = true;
                    });
                    }

                    // Initially, disable "Spesifik kelas" radio buttons
                    disableSpesifikKelas();
                
                    // Initially, disable all dropdowns
                    disableAllDropdowns();
                
                    // Add event listeners to detect radio button changes
                    radioPenghasilan.addEventListener("change", function() {
                        disableAllDropdowns();
                        enableDropdowns();
                        disableSpesifikKelas();
                    });
                
                    radioAgama.addEventListener("change", function() {
                        disableAllDropdowns();
                        enableDropdowns();
                        disableSpesifikKelas();
                    });

                    radioKps.addEventListener("change", function() {
                        disableAllDropdowns();
                        enableDropdowns();
                        disableSpesifikKelas();
                    });
                    
                    radioJk.addEventListener("change", function() {
                        disableAllDropdowns();
                        enableDropdowns();
                        disableSpesifikKelas();
                    });

                    // Add event listener to detect "tingkatan" dropdown changes
                    document.getElementById('tingkatan').addEventListener('change', function() {
                        const selectedTingkatan = this.value;
                        // Enable the "kelasTK" dropdown when "tingkatan" is set to "TK"
                        document.getElementById('kelasTK').disabled = (selectedTingkatan !== 'TK');
                        document.getElementById('kelasSD').disabled = (selectedTingkatan !== 'SD');
                        document.getElementById('kelasSMP').disabled = (selectedTingkatan !== 'SMP');

                        // Enable "Spesifik kelas" radio buttons only if "tingkatan" is not "TK"
                        const spesifikKelasRadios = formContainer.querySelectorAll('input[name="detaiKelas"]');
                        spesifikKelasRadios.forEach(radio => {x 
                            radio.disabled = (selectedTingkatan === 'TK');
                        });
                    });

                </script>

            </div>
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
<!-- pop up -->
<div class="filter-popup" id="filterPopup">
    <button type="button" class="btn btn-primary" id="applyBtn" hidden>Apply</button>
    <button type="button" class="btn btn-secondary" id="closeBtn" hidden>Close</button>
    <button type="submit" class="btn btn-primary float-center mt-3">Tampil</button>
</div>
{{-- <div>
    <button type="submit" class="btn btn-primary float-center mt-3">Tampil</button>
</div> --}}
{{-- <div class="grafik" style="width: 100%; max-width: 400px; margin: 0 auto;">
    <canvas id="jenisKelaminChart"></canvas>
</div>
<div class="grafik" style="width: 200%; max-width: 400px; margin: 0 auto;">
    <canvas id="agamaChart"></canvas>
    </div>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(isset($jumlahPerempuan) && isset($jumlahLakiLaki))
            var ctx = document.getElementById('jenisKelaminChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Perempuan', 'Laki-Laki'],
                    datasets: [{
                        data: [{{ $jumlahPerempuan }}, {{ $jumlahLakiLaki }}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true, // Tampilkan legend
                            position: 'top', // Atur posisi legend (top, left, bottom, right)
                            labels: {
                                font: {
                                    size: 12 // Atur ukuran font pada legend
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Grafik Jenis Kelamin Siswa'
                        }
                    }
                }
            });
        @endif


        @if(isset($jumlahIslam) && isset($jumlahKristen) && isset($jumlahKatolik) && isset($jumlahHindu) && isset($jumlahBuddha))
            var agamaCtx = document.getElementById('agamaChart').getContext('2d');
            var agamaChart = new Chart(agamaCtx, {
                type: 'bar',
                data: {
                    labels: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha'],
                    datasets: [{
                        label: 'Grafik agama siswa perkelas',
                        data: [{{ $jumlahIslam }}, {{ $jumlahKristen }}, {{ $jumlahKatolik }}, {{ $jumlahHindu }}, {{ $jumlahBuddha }}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        @endif
    });
    </script> --}}

@endsection

