@extends('layout-yayasan.second')
@section('isi-content')
    <div class="">
        <div class="judul" style="margin-top: 8%;">
            <p class="fs-3 fw-bold text-wrap text-center">Daftar Akun Operator Sekolah</p>
            <p class="fs-3 fw-bold text-wrap text-center">Yayasan Kanisius</p>
        </div>

    </div>
    <div class="ms-5">
        <a href="{{ route('tambah-akun') }}" class="btn btn-primary ms-5"><i class="fas fa-pen"></i>Tambah Akun</a>

        <button type="button" class="btn btn-info float-end me-4" onclick="goBack()">
                <i class="fas fa-arrow-left"></i> Kembali</button>
    </div>  
    <div class="data-siswa py-3" style=" margin-top:1%;">        
        <div class="table-data" style="margin-left: 1%; margin-right:1%; ">
            <table id="example" class="table table-bordered" style="width:100% ">
                <thead>
                    <tr class="text-center">
                        <th class="fw-bold fs-5">No</th>
                        <th class="fw-bold fs-5">Nama Pegawai</th>
                        <th class="fw-bold fs-5">Username</th>
                        <th class="fw-bold fs-5">Nama Sekolah</th>
                        <th class="fw-bold fs-5" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        @if ($item->status == 'sekolah')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->namasekolah }}</td>
                                <td>
                                    <a href="{{ route('dashboard.edit', ['id' => $item->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i>Edit</a>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.delete', ['id' => $item->id]) }}" class="btn btn-danger"
                                        onclick="event.preventDefault(); if (confirm('Anda yakin ingin menghapus data ini?')) document.getElementById('delete-form-{{ $item->id }}').submit();">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </a>
                                </td>
                                
                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('dashboard.delete', ['id' => $item->id]) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-center">
                        <th class="fw-bold fs-5">No</th>
                        <th class="fw-bold fs-5">Nama Pegawai</th>
                        <th class="fw-bold fs-5">Username</th>
                        <th class="fw-bold fs-5">Nama Sekolah</th>
                        <th class="fw-bold fs-5" colspan="2">Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
    </div>
    </div>
@endsection
