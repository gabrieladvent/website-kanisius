@extends('layout-yayasan.second')

@section('isi-content')
    <div class="container px-5 ms-5 mt-5">
        <div class="mt-5"><h1>Pengaturan Portal Upload</h1></div>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('set-portal') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="file_name">File Name</label>
                <input type="text" name="file_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="upload_start">Upload Start</label>
                <input type="datetime-local" name="upload_start" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="upload_end">Upload End</label>
                <input type="datetime-local" name="upload_end" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>


    @php
        if (\Session::get('upload_start')) {
            $uploadStart = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', Session::get('upload_start'));
            $uploadEnd = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', Session::get('upload_end'));
            $currentDateTime = date('Y-m-d\TH:i:s');
            if (\Carbon\Carbon::now()->between($uploadStart, $uploadEnd)) {
                echo 'ada upload';
            } else {
                echo 'Upload tidak tersedia saat ini.';
            }
        }
    @endphp
@endsection
