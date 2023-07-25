@extends('layout-yayasan.second')

@section('isi-content')
<div class="toper">
    <h2>Message</h2>
    <div class="message-box" style="background-color: white; box-shadow:4px 7px 10px rgba(0,0,0,.4);padding:1%">
    <table class="table table-bordered">
            @if ($user->status === 'yayasan')
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Sekolah</th>
                        <th>Nama File</th>
                        <th>Komentar</th>
                        <th>Tanggal Waktu Kirim</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifikasi as $notif)
                    <tr>
                        
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $notif->user->namasekolah }}</td>
                        <td>{{ $notif->nama_file }}</td>
                        <td>
                            @unless (empty($notif->Komentar))
                                {{ $notif->Komentar }}
                            @else
                                Tidak ada komentar
                            @endunless
                        </td>
                        <td>{{ $notif->created_at }}</td>
                        <td>
                            <a href="{{ route('kiriman-data') }}" class="btn btn-primary">Lihat</a>
                            <a href="#" class="btn btn-primary">Downlaod dan Upload</a>
                        </td>
                    </tr>
                    @endforeach
            @else
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama File</th>
                        <th>Komentar</th>
                        <th>Tanggal Kirim</th>
                        <th>Waktu Kirim</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifikasi as $notif)
                    <tr>
                        
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $notif['nama_file'] }}</td>
                        <td>
                            @unless (empty($notif['komentar']))
                                {{ $notif['komentar'] }}
                            @else
                                Tidak ada komentar
                            @endunless
                        </td>
                        <td>{{ $notif['tanggal'] }}</td>
                        <td>{{ $notif['waktu'] }}</td>
                        <td>
                            Berhasil 
                            {{-- Ini ada sedikit perbaikan --}}
                        </td>
                    </tr>
                    @endforeach
            @endif
                
        </tbody>
    </table>
</div>
</div>
@endsection
