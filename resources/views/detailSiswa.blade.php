@extends('layout-yayasan.second')
@section('isi-content')
    @foreach ($data as $item)
        <div class="row gutters-sm px-5 mt-5">
            <div class="col-md-4 mb-3 mt-5">
                <div class="card">
                    {{-- https://bootdey.com/img/Content/avatar/avatar7.png --}}
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if ($item->JK === 'L')
                                <img src="{{ asset('/icon/laki.png') }}" alt="" class="rounded-circle"
                                width="150">
                            @else
                                <img src="{{ asset('/icon/cewe.png') }}" alt="" class="rounded-circle"
                                 width="150">
                            @endif
                            
                            <div class="mt-3">
                                <h4>{{ $item->Nama }}</h4>
                                @if ($item->JK === 'P')
                                <p class="text-muted font-size-sm mb-1">Perempuan</p>
                                @else
                                <p class="text-muted font-size-sm mb-1">Laki-Laki</p>
                                @endif
                                <p class="text-secondary mb-1">NISN: {{ $item->NISN }}</p>
                                <p class="text-muted font-size-sm mb-1">NIPD: {{ $item->NIPD }}</p>
                                <p class="text-muted font-size-sm mb-1">Tempat Tanggal Lahir: {{ $item->Tempat_lahir .', '. \Carbon\Carbon::createFromFormat('Y-m-d', $item->Tanggal_Lahir)->format('d-m-Y') }}</p>
                                <p class="text-secondary mb-1">NIK: {{ $item->NIK }}</p>
                                <p class="text-secondary mb-1">Akta Lahir: {{ $item->No_Registrasi_Akta_Lahir }}</p>
                                <p class="text-secondary mb-1">Agama: {{ $item->Agama }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Telepon</h6>
                            <span class="text-secondary">{{ $item->Telepon ? $item->Telepon : '-' }} </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Nomor Handphone</h6>
                            <span class="text-secondary">0{{ $item->HP ? $item->HP : '-' }} </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Email</h6>
                            <span class="text-secondary">{{ $item->Email ? $item->Email : '-' }} </span>
                        </li>
                        <li class="list-group-item justify-content-between align-items-center flex-wrap">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">Nama Bank</h6>
                                    <span class="text-secondary">{{ $item->Bank ? $item->Bank : '-' }} </span>
                                </div>
                                <div class="col">
                                    <h6 class="mb-0">Nama Rekening</h6>
                                    <span class="text-secondary">{{ $item->Rekening_atas_nama ? $item->Rekening_atas_nama : '-' }} </span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Nomor Rekening</h6>
                            <span class="text-secondary">{{ $item->Nomor_Rekening_Bank ? $item->Nomor_Rekening_Bank : '-' }} </span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-4 mt-5">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Alamat</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                                {{ $item->Alamat ? $item->Alamat . ', ' : '' }}
                                {{ $item->RT ? $item->RT . ', ' : '' }}
                                {{ $item->RW ? $item->RW . ', ' : '' }}
                                {{ $item->Dusun ? $item->Dusun . ', ' : '' }}
                                {{ $item->Kelurahan ? $item->Kelurahan . ', ' : '' }}
                                {{ $item->Kecamatan ? $item->Kecamatan . ', ' : '' }}
                                {{ $item->kode_pos ? $item->kode_pos : '' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Jenis Tinggal</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                                {{ $item->Jenis_Tinggal }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Alat Transportasi</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                                {{$item->Alat_Transportasi}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Anak Ke Berapa</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                                {{ $item->Anak_ke_berapa }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Berat/Tinggi Badan/Lingkar Kepala</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                                {{ $item->Berat_Badan . '/' .  $item->Tinggi_badan .'/'. $item->Lingkar_Kepala }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Berkebutuhan Khusus</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                                {{ $item->Kebutuhan_Khusus }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Jarak Rumah Ke Sekolah</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                                {{ $item->Jarak_Rumah_ke_Sekolah }} Km 
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Latitude dan Longitude</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                                {{ $item->Lintang }} dan {{ $item->bujur }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mt-5">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Kelas</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                               {{ $item->Rombel_Set_Ini }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Nomor Seri Ijazah</h6>
                            </div>
                            <div class="col">SKHUN</div>
                            <div class="col-sm-12 text-secondary">
                                <div class="row">
                                    <div class="col">{{ $item->No_Seri_Ijazah ? $item->No_Seri_Ijazah : '-'  }}</div>
                                    <div class="col">{{ $item->SKHUN ? $item->SKHUN : '-'  }}</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Nomor Peserta Ujian</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                                {{ $item->No_Peserta_Ujian_Nasional ? $item->No_Peserta_Ujian_Nasional : '-'  }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Penerima KIP</h6>
                            </div>
                            <div class="col">Nomor KIP</div>
                            <div class="col">Nama KIP</div>
                            <div class="col-sm-12 text-secondary">
                                <div class="row">
                                    <div class="col">{{ $item->Penerima_KIP }}</div>
                                    <div class="col">{{ $item->Nomor_KIP ? $item->Nomor_KIP : '-'  }}</div>
                                    <div class="col">{{ $item->Nama_di_KIP ? $item->Nama_di_KIP : '-'  }}</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Layak PIP</h6>
                            </div>
                            <div class="col">Alasan</div>
                            <div class="col-sm-12 text-secondary">
                                <div class="row">
                                    <div class="col">{{ $item->Layak_PIP }}</div>
                                    <div class="col">{{ $item->Alasan_Layak_PIP ? $item->Alasan_Layak_PIP : '-'  }}</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Penerima KPS</h6>
                            </div>
                            <div class="col">Nomor KPS</div>
                            <div class="col-sm-12 text-secondary">
                                <div class="row">
                                    <div class="col">{{ $item->Penerima_KPS }}</div>
                                    <div class="col">{{ $item->No_KPS ? $item->No_KPS : '-'  }}</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Nomor KKS</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                                {{ $item->No_KKS ? $item->No_KKS : '-'  }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0">Sekolah Asal</h6>
                            </div>
                            <div class="col-sm-12 text-secondary">
                                {{ $item->Sekolah_Asal ? $item->Sekolah_Asal : '-'  }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="row gutters-sm">
                    <div class="col-sm-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="mb-0">Data Ayah</h4>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Nama Ayah</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Nama_Ayah ? $item->Nama_Ayah : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Tahun Lahir</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Tahun_Lahir_Ayah ? $item->Tahun_Lahir_Ayah : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">NIK Ayah</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->NIK_Ayah ? $item->NIK_Ayah : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Jenjang Pendidikan</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Jenjang_Pendidikan_Ayah ? $item->Jenjang_Pendidikan_Ayah : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Pekerjaan</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Pekerjaan_Ayah ? $item->Pekerjaan_Ayah : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Penghasilan</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Penghasilan_Ayah ? $item->Penghasilan_Ayah : '-'  }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="mb-0">Data Ibu</h4>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Nama Ibu</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Nama_ibu ? $item->Nama_ibu : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Tahun Lahir</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Tahun_Lahir_Ibu ? $item->Tahun_Lahir_Ibu : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">NIK Ibu</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->NIK_Ibu ? $item->NIK_Ibu : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Jenjang Pendidikan</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Jenjang_Pendidikan_Ibu ? $item->Jenjang_Pendidikan_Ibu : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Pekerjaan</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Pekerjaan_Ibu ? $item->Pekerjaan_Ibu : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Penghasilan</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Penghasilan_Ibu ? $item->Penghasilan_Ibu : '-'  }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>     

                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-sm-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="mb-0">Data Wali</h4>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Nama wali</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Nama_wali ? $item->Nama_wali : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Tahun Lahir</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Tahun_Lahir_wali ? $item->Tahun_Lahir_wali : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">NIK wali</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->NIK_wali ? $item->NIK_wali : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Jenjang Pendidikan</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Jenjang_Pendidikan_wali ? $item->Jenjang_Pendidikan_wali : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Pekerjaan</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Pekerjaan_wali ? $item->Pekerjaan_wali : '-'  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0">Penghasilan</h6>
                                    </div>
                                    <div class="col-sm-12 text-secondary">
                                        {{ $item->Penghasilan_wali ? $item->Penghasilan_wali : '-'  }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-info px-5" onclick="goBack()">
                <i class="fas fa-arrow-left"></i> Kembali</button>
            </div>
            
        </div>
    @endforeach
@endsection
