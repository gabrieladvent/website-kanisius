@extends('layout-yayasan.second')

@section('isi-content')
<div class="toper">
    <h2>Message</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Sekolah</th>
                <th>Tanggal Waktu Kirim</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $counter = 1;
            @endphp
            @foreach($notifikasi as $notif)
            <tr>
                
                <td>{{ $counter }}</td>
                <td>{{ $users[$notif->ID] }}</td>
                <td>{{ $notif->created_at }}</td>
                <td>
                    <a href="#" class="btn btn-primary">Lihat</a>
                    <a href="#" class="btn btn-primary">Downlaod dan Upload</a>
                </td>
            </tr>
            @php
            $counter++;
            @endphp
            @endforeach
        </tbody>
    </table>
</div>
@endsection
