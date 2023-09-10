<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Sekolah;
use App\Models\User as user;
use App\Models\Siswa;
use App\Models\Siswa_Tk;
use App\Models\Arship;
use App\Models\Arsip_TK;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        switch ($this->data['laporanType']) {
            case 'jk':
                return $this->mapDataForJenisKelamin();
            case 'agama':
                return $this->mapDataForAgama();
            case 'penghasilan':
                return $this->mapDataForPenghasilan();
            case 'kps':
                return $this->mapDataForKPS();
            case 'zonasi':
                return $this->mapDataForZonasi();
            case 'jumlah_siswa':
                return $this->mapDataForJumlahSiswa();
            default:
                return [];
        }
    }

    private function mapDataForJenisKelamin()
{
    // Lakukan pemetaan data untuk laporan Jenis Kelamin di sini
    $sekolah = Sekolah::all();
    $dataSiswa = $this->data['data_siswa'];
    $dataSiswaTK = $this->data['data_siswatk'];
    $jumlahLakiLaki = $this->data['jumlahLakiLaki'];
    $jumlahPerempuan = $this->data['jumlahPerempuan'];
    $totalJL = $this->data['totalJL'];

    // Kembalikan data dalam format yang sesuai
    return [
        [
            'Title' => 'Judul Laporan',
            'Sekolah' => $sekolah,
            'Data Siswa' => $dataSiswa,
            'Data Siswa TK' => $dataSiswaTK,
            'Jumlah Laki-Laki' => $jumlahLakiLaki,
            'Jumlah Perempuan' => $jumlahPerempuan,
            'Total JL' => $totalJL,
            // Tambahkan field lain sesuai kebutuhan
        ]
    ];
}


private function mapDataForAgama()
{
    // Lakukan pemetaan data untuk laporan Agama di sini
    $sekolah = Sekolah::all();
    $dataSiswa = $this->data['data_siswa'];
    $dataSiswaTK = $this->data['data_siswatk'];
    $siswaCounts = $this->data['siswaCounts'];
    $siswaCountsTK = $this->data['siswaCountstk'];

    // Kembalikan data dalam format yang sesuai
    return [
        [
            'Title' => 'Judul Laporan',
            'Sekolah' => $sekolah,
            'Data Siswa' => $dataSiswa,
            'Data Siswa TK' => $dataSiswaTK,
            'Siswa Counts' => $siswaCounts,
            'Siswa Counts TK' => $siswaCountsTK,
            // Tambahkan field lain sesuai kebutuhan
        ]
    ];
}


private function mapDataForPenghasilan(){
    $sekolah = Sekolah::all();
    $dataSiswa = $this->data['data_siswa'];

    // Kembalikan data dalam format yang sesuai
    return [
        [
            'Title' => 'Judul Laporan',
            'Sekolah' => $sekolah,
            'Data Siswa' => $dataSiswa,
            // Tambahkan field lain sesuai kebutuhan
        ]
    ];
}

private function mapDataForKPS()
{
    // Lakukan pemetaan data untuk laporan KPS di sini
    $sekolah = Sekolah::all();
    $dataSiswa = $this->data['data_siswa'];
    $layakPIPCounts = $this->data['layakPIPCounts'];

    // Kembalikan data dalam format yang sesuai
    return [
        [
            'Title' => 'Judul Laporan',
            'Sekolah' => $sekolah,
            'Data Siswa' => $dataSiswa,
            'Layak PIP Counts' => $layakPIPCounts,
            // Tambahkan field lain sesuai kebutuhan
        ]
    ];
}

private function mapDataForZonasi()
{
    // Lakukan pemetaan data untuk laporan Zonasi di sini
    $sekolah = Sekolah::all();
    $dataSiswa = $this->data['data_siswa'];
    $rataRataJarak = $this->data['rataRataJarak'];

    // Kembalikan data dalam format yang sesuai
    return [
        [
            'Title' => 'Judul Laporan',
            'Sekolah' => $sekolah,
            'Data Siswa' => $dataSiswa,
            'Rata-Rata Jarak' => $rataRataJarak,
            // Tambahkan field lain sesuai kebutuhan
        ]
    ];
}

private function mapDataForJumlahSiswa()
{
    // Lakukan pemetaan data untuk laporan jumlah siswa di sini
    $sekolah = Sekolah::all();
    $dataSiswa = $this->data['data_siswa'];
    $dataSiswaTK = $this->data['data_siswatk'];
    $dataSiswaArsip = $this->data['data_siswa_arsip'];
    $dataSiswaArsipTK = $this->data['data_siswa_arsipTK'];
    $combinedData = $this->data['combined_data'];

    // Kembalikan data dalam format yang sesuai
    return [
        [
            'Title' => 'Judul Laporan',
            'Sekolah' => $sekolah,
            'Data Siswa' => $dataSiswa,
            'Data Siswa TK' => $dataSiswaTK,
            'Data Siswa Arsip' => $dataSiswaArsip,
            'Data Siswa Arsip TK' => $dataSiswaArsipTK,
            'Combined Data' => $combinedData,
            // Tambahkan field lain sesuai kebutuhan
        ]
    ];
}


public function headings(): array
{
    return [
        'Title',
        'Sekolah',
        'Data Siswa',
        'Data Siswa TK',
        'Data Siswa Arsip',
        'Data Siswa Arsip TK',
        'Combined Data',
        // Tambahkan field lain sesuai kebutuhan
    ];
}

}
    
