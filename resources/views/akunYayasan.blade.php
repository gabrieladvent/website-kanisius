@extends('layout-yayasan.second')
@section('isi-content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <div class="data-siswa1 py-2">
        <div class="table-data d-flex justify-content-center align-items-center"
            style="margin-left: 1%; margin-right: 1%; height: 100%;">
            <div>
                <p class="fs-3 fw-bold text-wrap text-center">Daftar Akun Operator Sekolah</p>
                <p class="fs-3 fw-bold text-wrap text-center">Yayasan Kanisius</p>
            </div>
        </div>
    </div>

    <div class="ms-5" style="margin-top :2%">
        <div class="col ps-2">
            <a href="{{ route('tambah-akun') }}" class="btn btn-success ms-5">Tambah Akun <i class="fas fa-pen"></i>
            </a>

            <button type="button" class="btn btn-danger float-statrt ms-2 mt-4" onclick="goBack()">Kembali <i
                    class="fas fa-arrow-left"></i></button>
        </div>
    </div>

    <div class="data-siswa py-3" style=" margin-top:1%;">
        <div class="table-data" style="margin-left: 1%; margin-right:1%; ">
            <table id="akun" class="table table-bordered" style="width:100% ">
                <thead>
                    <tr class="text-center">
                        <th class="fw-bold fs-5">No</th>
                        <th class="fw-bold fs-5">Nama Pegawai</th>
                        <th class="fw-bold fs-5">Username</th>
                        <th class="fw-bold fs-5">Nama Sekolah</th>
                        <th class="fw-bold fs-5">Action</th>
                        <th class="fw-bold fs-5">Action</th>
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
                                    <a href="{{ route('dashboard.edit', ['id' => $item->id]) }}" class="btn btn-primary"><i
                                            class="fas fa-pen"></i>Edit</a>
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
                        <th class="fw-bold fs-5" >Action</th>
                        <th class="fw-bold fs-5" >Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
    </div>
    <script>
        new DataTable('#akun');
    </script>
@endsection
