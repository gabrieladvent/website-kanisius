@extends('layout-sekolah.second')
@section('isi-content')
    <div class="row mt-5 ms-5 shadow-5-strong">
        <div class="row mt-5 ms-5">
            <div class="col">
                <p>Availability</p>
                <div class="row">
                    <div class="col">
                        <p>Due date : </p>
                    </div>
                    <div class="col-1">
                        <form method="post" action="{{ route('check-button', ['slug' => $user->id]) }}">
                            @csrf
                            <!-- Bagian Tanggal -->
                            <select id="select-day" name="start-day">
                                <!-- Options for dates -->
                                @for ($day = 1; $day <= 31; $day++)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endfor
                            </select>
                    </div>
                    <div class="col">
                        <!-- Bagian Bulan -->
                        <select id="select-month" name="start-month">
                            <!-- Options for months -->
                            @for ($month = 1; $month <= 12; $month++)
                                <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col">
                        <!-- Bagian Tahun -->
                        <select id="select-year" name="start-year">
                            <!-- Options for years -->
                            @php
                                $currentYear = date('Y');
                                $startYear = 2020;
                            @endphp
                            @for ($year = $currentYear; $year >= $startYear; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-1">
                        <!-- Bagian Jam -->
                        <select id="select-hour" name="start-hour">
                            <!-- Options for hours -->
                            @for ($hour = 0; $hour <= 23; $hour++)
                                <option value="{{ $hour }}">{{ sprintf('%02d', $hour) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col">
                        <!-- Bagian Menit -->
                        <select id="select-minute" name="start-minute">
                            <!-- Options for minutes -->
                            @for ($minute = 0; $minute <= 59; $minute++)
                                <option value="{{ $minute }}">{{ sprintf('%02d', $minute) }}</option>
                            @endfor
                        </select>

                    </div>

                    {{-- cut off --}}
                </div>
                <div class="row mt-2  ">
                    <div class="col">
                        <p>Cut Off : </p>
                    </div>
                    <div class="col-1 ">
                        <!-- Bagian Tanggal -->
                        <select id="select-day" name="end-day">
                            <!-- Options for dates -->
                            @for ($day = 1; $day <= 31; $day++)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col">
                        <!-- Bagian Bulan -->
                        <select id="select-month" name="end-month">
                            <!-- Options for months -->
                            @for ($month = 1; $month <= 12; $month++)
                                <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col ">
                        <!-- Bagian Tahun -->
                        <select id="select-year" name="end-year">
                            <!-- Options for years -->
                            @php
                                $currentYear = date('Y');
                                $startYear = 2000;
                            @endphp
                            @for ($year = $currentYear; $year >= $startYear; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-1  ">
                        <!-- Bagian Jam -->
                        <select id="select-hour" name="end-hour">
                            <!-- Options for hours -->
                            @for ($hour = 0; $hour <= 23; $hour++)
                                <option value="{{ $hour }}">{{ sprintf('%02d', $hour) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col mb-8">
                        <!-- Bagian Menit -->
                        <select id="select-minute" name="end-minute">
                            <!-- Options for minutes -->
                            @for ($minute = 0; $minute <= 59; $minute++)
                                <option value="{{ $minute }}">{{ sprintf('%02d', $minute) }}</option>
                            @endfor
                        </select>

                    </div>

                </div>


                <div id="information">
                    @if (session('activeStartTime'))
                        <p>Waktu Mulai Aktif: {{ session('activeStartTime')->format('Y-m-d H:i') }}</p>
                    @endif
                    @if (session('activeEndTime'))
                        <p>Batas Waktu Nonaktif: {{ session('activeEndTime')->format('Y-m-d H:i') }}</p>
                    @endif
                </div>

                <div class="row">
                    <div class="col">
                        <button class="btn bg-dark text-white float-end me-5 mb-5">Submit</button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection
