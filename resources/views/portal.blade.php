@extends('layout-yayasan.second')
@section('isi-content')
    <div class="container px-5 ms-5 mt-5">
        <div class="mt-5">
            <h1>Pengaturan Portal Upload</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('set-portal') }}" method="POST">
            @csrf
            <div class="form-group col-5 justify-content-center">
                <label for="file_name">File Name</label>
                <input type="text" name="file_name" id="file_name" class="form-control" required>
            </div>

            <div class="form-group col-5">
                <label for="upload_start">Upload Start</label>
                <input type="datetime-local" name="upload_start"class="form-control" required>
            </div>

            @foreach ($time as $s)
                <div class="form-group col-5">
                    <label for="upload_end">Upload End</label>
                    <input type="datetime-local" name="upload_end" class="form-control" required>
                </div>
                <input type="text" id="upload_end" value="{{ $s->upload_end }}" hidden>
            @endforeach

            <button id="submit" type="submit" class="btn btn-primary mt-4">Create</button>
        </form>

        <div id="selection">
            <input type="button" class="select" hidden id="select-button" value="Countdown!">
        </div>

        <div class="grid-wrapper mt-5 me-5 col">
            <div class="grid-container">
                <div class="grid-item Years" id="Years">00</div>
                <div class="grid-item Days" id="Days">00</div>
                <div class="grid-item Hours" id="Hours">00</div>
                <div class="grid-item Minutes" id="Minutes">00</div>
                <div class="grid-item Seconds" id="Seconds">00</div>
                <div class="grid-item Year">Year(s)</div>
                <div class="grid-item Day">Day(s)</div>
                <div class="grid-item Hour">Hour(s)</div>
                <div class="grid-item Minute">Minute(s)</div>
                <div class="grid-item Second">Second(s)</div>
            </div>
        </div>

        <p class="until">
            <span id="span-event"></span>
            <br>
            <span id="span-datetime"></span>
        </p>
        
    </div>



@endsection
