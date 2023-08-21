@extends('layout-sekolah.second')
@section('isi-content')
<div class="row px-5">
    <div class="col-2  mt-5 ms-5">
        <div class="row mt-5 shadow-3-strong bg-light">
            <div class="col mt-3 ms-1">
                <div>
                    <label class="ms-2">ID User</label>
                    <p class="ms-2 fs-5"> {{ $user->id }} </p>
                </div>
                <div class="">
                    <label class="ms-2">Nama User</label>
                    <p class="ms-2 border border-secondary-subtle fs-5"> {{ $user->name }} </p>
                </div>
                <div class="">
                    <label class="ms-2">Nama Sekolah</label>
                    <p class="ms-2 fs-5">{{ $user->namasekolah }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col mt-5">
        <div class="row mt-5 mb-5 ms-5 d-flex shadow-3-strong bg-light">
            <div class="col px-4 mt-3 mb-3">
                <div class="row">
                    <table class="table table-striped table-bordered" style="background-color: #ffffff;">
                        <thead class="text-center">
                            <th>Nomor</th>
                            <th>Nama File</th>
                            <th>Komentar</th>
                            <th>Tanggal Upload</th>
                            <th>Status</th>
                        </thead>
                        <tbody class="table-group-divider">
                            @forelse ($data as $item)
                                <tr class="">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_file}}</td>
                                    <td>
                                        @unless (empty($item->Komentar))
                                            {{ $item->Komentar }}
                                        @else
                                            <i>Tidak ada komentar</i>
                                        @endunless    
                                    </td>
                                    <td>{{ $item->created_at->format('Y-m-d')}}</td>
                                    <td class="text-dark" style="background-color: #A9E9A9">Sukses</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No Record</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection