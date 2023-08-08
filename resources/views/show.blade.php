
    <!-- Your view content goes here -->

    <div>
        <h2>Notification Details</h2>
        <p>ID: {{ $notifikasi->id }}</p>
        <p>Notification Message: {{ $notifikasi->notification_message }}</p>

        <h3>Data Siswa</h3>
        <table>
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($data_siswa as $item)
                    <tr>
                        <td>{{ $item[4] }}</td>
                        <td>{{ $item[1] }}</td>
                        <td>{{ $item[6] }}</td>
                        <td>{{ $item[3] }}</td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
