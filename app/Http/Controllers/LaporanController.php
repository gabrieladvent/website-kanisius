<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa_Tk;
use App\Models\Arsip_TK;
use App\Models\Arship;
use PDF;
use Dompdf\Dompdf;
use Symfony\Component\HttpFoundation\Response; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    public function laporan($title)
    {
        $user = Auth::user();
        $siswa = Siswa::all();
        $siswaTK = Siswa_TK::all();
        $siswaArship = Arship::all();
        $siswaArshipTK = Arsip_TK::all();

        $data_siswa = $siswa->load('sekolah');
        $data_siswatk = $siswaTK->load('sekolah');
        $data_siswa = $data_siswa->concat($siswaTK->load('sekolah'));
        $sekolah = Sekolah::all();

        $data_siswa_arsip = $siswaArship->load('sekolah');
        $data_siswa_arsipTK =  $siswaArshipTK->load('sekolah');

        return view('laporan', compact('data_siswa', 'sekolah', 'title', 'user', 'data_siswatk', 'data_siswa_arsip', 'data_siswa_arsipTK'));
    }


    public function showTable(Request $request, $title)
    {
        $user = Auth::user();

        // Bangun kueri dasar untuk mengambil model Siswa dengan relasi sekolah yang sudah dimuat eager

        $kolom = ['NISN', 'Nama', 'JK', 'Rombel_Set_Ini'];

        if ($request->has('laporanType') === 'jk') {
            //$kolom[] = 'Agama';
            $kolom = ['NISN', 'Nama', 'JK', 'Rombel_Set_Ini'];
        }
        if ($request->has('laporanType') === 'zonasi') {
            $kolom[] = 'Jarak_Rumah_ke_Sekolah';
        }

        $data_siswa = Siswa::select($kolom)->get();

        return view('laporan', compact('kolom', 'data_siswa', 'title', 'user'));
    }

    public function filter(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'laporanType' => 'required'
        ]);
        $query = Siswa::with('sekolah');
        $querytk = Siswa_TK::with('sekolah');
        $query2 = Arship::with('sekolah');
        $queryTkArsip = Arsip_TK::with('sekolah');

        $namaSekolah = $request->input('namaSekolah');
        $tingkatan = $request->input('tingkatan');
        $detailKelas = $request->input('detailKelas');

        if ($namaSekolah) {
            $query = $query->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', $request->namaSekolah);
            });
            $querytk = $querytk->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', $request->namaSekolah);
            });
            $query2->whereHas('sekolah', function ($subQuery) use ($namaSekolah) {
                $subQuery->where('NAMASEKOLAH', $namaSekolah);
            });
            $queryTkArsip->whereHas('sekolah', function ($subQuery) use ($namaSekolah) {
                $subQuery->where('NAMASEKOLAH', $namaSekolah);
            });
        } elseif ($tingkatan) {
            $query2->whereHas('sekolah', function ($subQuery) use ($tingkatan) {
                $subQuery->where('NAMASEKOLAH', 'LIKE', $tingkatan . '%');
            });
            $queryTkArsip->whereHas('sekolah', function ($subQuery) use ($tingkatan) {
                $subQuery->where('NAMASEKOLAH', 'LIKE', $tingkatan . '%');
            });
            $query = $query->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', 'LIKE', $request->tingkatan . '%');
            });
        }

        //data siswa 
        if ($request->has('detailKelas') || $request->hasAny(['kelasSD', 'kelasSMP', 'kelasTK'])) {
            $query->where(function ($query) use ($request) {
                $selectedKelas = null;
                $detailKelas = $request->input('detailKelas');

                if ($request->has('kelasSD')) {
                    $selectedKelas = $request->input('kelasSD');
                } elseif ($request->has('kelasSMP')) {
                    $selectedKelas = $request->input('kelasSMP');
                } elseif ($request->has('kelasTK')) {
                    $selectedKelas = $request->input('kelasTK');
                }


                if ($selectedKelas) {
                    if ($detailKelas === 'semua') {
                        // Jika detailKelas adalah 'semua', maka gunakan pola '%' untuk mencocokkan semua
                        $rombelSetIni = $selectedKelas . '%';
                    } else {
                        // Jika detailKelas bukan 'semua', maka gunakan pola tertentu
                        $rombelSetIni = $selectedKelas . $detailKelas;
                    }
                    $query->where('Rombel_Set_Ini', 'LIKE', $rombelSetIni);
                }
            });
        }



        if ($detailKelas || $request->hasAny(['kelasSD', 'kelasSMP', 'kelasTK'])) {
            $kelasType = $request->input('kelasSD') ?? $request->input('kelasSMP') ?? $request->input('kelasTK');
            $rombelSetIni = ($kelasType) ? $kelasType . $detailKelas : '%' . $detailKelas . '%';

            $query2->where(function ($subQuery) use ($rombelSetIni) {
                $subQuery->where('Rombel_Set_Ini', 'LIKE', $rombelSetIni);
            });
        }

        $data_siswa = $query->get();
        $data_siswatk = $querytk->get();
        $data_siswa_arsip = $query2->get();
        $data_siswa_arsipTK = $queryTkArsip->get();

        switch ($request->laporanType) {
            case 'jk':
                $data = self::filterJenisKelamin($request, $data_siswa, $data_siswatk);
                return view ('laporan',[
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all(),
                    'data_siswa' => $data_siswa,
                    'data_siswatk' => $data_siswatk,

                    // 'jumlahLakiLaki' => $data['jumlah_cwo'],
                    // 'jumlahPerempuan' => $data['jumlah_cwe'],
                    // 'totalJL' => $data['total'],

                    'jumlahLakiLakiGeneral' => $data['jumlah_cwo_general'],
                    'jumlahPerempuanGeneral' => $data['jumlah_cwe_general'],
                    'totalGeneral' => $data['total_general'],
                    'jumlahLakiLakiTk' => $data['jumlah_cwo_tk'],
                    'jumlahPerempuanTk' => $data['jumlah_cwe_tk'],
                    'totalTk' => $data['total_tk']

                ]);
              
            case 'agama':
                $data = self::filterAgama($request, $query, $querytk);
                return view('laporan', [
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all(),
                    'data_siswa' => $data_siswa,
                    'data_siswatk' => $data_siswatk,

                    // 'layakPIPCounts ' => $data['layakPIPCounts'],
                    'siswaCounts' => $data['siswaCounts'],
                    'siswaCountstk' => $data['siswaCountstk']
                ]);
            case 'penghasilan':
                return view('laporan', [
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all(),
                    'data_siswa' => $query->get()
                ]);
            case 'kps':
                $data = self::filterKPS($request, $query);
                return view('laporan', [
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all(),
                    'data_siswa' => $data_siswa,
                    'layakPIPCounts' => $data['layakPIPCounts']
                ]);

            case 'zonasi':
                $data = self::filterZonasi($request, $data_siswa);
                return view('laporan', [
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all(),
                    'data_siswa' => $query->get(),
                    'rataRataJarak' => $data
                ]);
            case 'jumlah_siswa':
                $data = self::filterJS($request, $data_siswa_arsip, $data_siswa_arsipTK);
                return view('laporan', [
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all(),
                    'data_siswa' => $query->get(),
                    'data_siswatk' => $querytk->get(),
                    'data_siswa_arsip' => $query2->get(),
                    'data_siswa_arsipTK' => $queryTkArsip->get(),
                    'combined_data' => $data
                ]);

            default:
                // dd($request->laporanType);
                abort(404);
        }
        abort(404);
    }



   

    public function cetakLaporan(Request $request)
   {
        $user = Auth::user();
        $request->validate([
            'laporanType' => 'required'
        ]);
        $query = Siswa::with('sekolah');
        $querytk = Siswa_TK::with('sekolah');
        $query2= Arship::with('sekolah');
        $queryTkArsip = Arsip_TK::with('sekolah');

        $namaSekolah = $request->input('namaSekolah');
        $tingkatan = $request->input('tingkatan');
        $detailKelas = $request->input('detailKelas');

        if ($namaSekolah) {
            $query = $query->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', $request->namaSekolah);
            });
            $querytk = $querytk->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', $request->namaSekolah);
            });
            $query2->whereHas('sekolah', function ($subQuery) use ($namaSekolah) {
                $subQuery->where('NAMASEKOLAH', $namaSekolah);
            });
            $queryTkArsip->whereHas('sekolah', function ($subQuery) use ($namaSekolah) {
                $subQuery->where('NAMASEKOLAH', $namaSekolah);
            });
        } elseif ($tingkatan) {
            $query2->whereHas('sekolah', function ($subQuery) use ($tingkatan) {
                $subQuery->where('NAMASEKOLAH', 'LIKE', $tingkatan . '%');
            });
            $queryTkArsip->whereHas('sekolah', function ($subQuery) use ($tingkatan) {
                $subQuery->where('NAMASEKOLAH', 'LIKE', $tingkatan . '%');
            });
            $query = $query->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', 'LIKE', $request->tingkatan . '%');
            });
        }

        //data siswa 
        if ($request->has('detailKelas') || $request->hasAny(['kelasSD', 'kelasSMP', 'kelasTK'])) {
            $query->where(function ($query) use ($request) {
                $selectedKelas = null;
                $detailKelas = $request->input('detailKelas');

                if ($request->has('kelasSD')) {
                    $selectedKelas = $request->input('kelasSD');
                } elseif ($request->has('kelasSMP')) {
                    $selectedKelas = $request->input('kelasSMP');
                } elseif ($request->has('kelasTK')) {
                    $selectedKelas = $request->input('kelasTK');
                }


                if ($selectedKelas) {
                    if ($detailKelas === 'semua') {
                        // Jika detailKelas adalah 'semua', maka gunakan pola '%' untuk mencocokkan semua
                        $rombelSetIni = $selectedKelas . '%';
                    } else {
                        // Jika detailKelas bukan 'semua', maka gunakan pola tertentu
                        $rombelSetIni = $selectedKelas . $detailKelas;
                    }
                    $query->where('Rombel_Set_Ini', 'LIKE', $rombelSetIni);
                   }
                });
            }
            
        

        if ($detailKelas || $request->hasAny(['kelasSD', 'kelasSMP', 'kelasTK'])) {
            $kelasType = $request->input('kelasSD') ?? $request->input('kelasSMP') ?? $request->input('kelasTK');
            $rombelSetIni = ($kelasType) ? $kelasType . $detailKelas : '%' . $detailKelas . '%';
            
            $query2->where(function ($subQuery) use ($rombelSetIni) {
                $subQuery->where('Rombel_Set_Ini', 'LIKE', $rombelSetIni);
            });
        }

        $data_siswa = $query->get();
        $data_siswatk = $querytk->get();
        $data_siswa_arsip = $query2->get();
        $data_siswa_arsipTK = $queryTkArsip->get();

        switch ($request->laporanType) {
            case 'jk':
                $data = self::filterJenisKelamin($request, $data_siswa, $data_siswatk);
                $export = new LaporanExport([
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all()->toArray(),
                    'data_siswa' => $data_siswa,
                    'data_siswatk' => $data_siswatk,
                    'jumlahLakiLaki' => $data['jumlah_cwo'],
                    'jumlahPerempuan' => $data['jumlah_cwe'],
                    'totalJL' => $data['total'],
                    'laporanType' =>'jk',
                ]);
    
                // Export ke file Excel
                return Excel::download($export, 'laporan.xlsx');
               
              
            case 'agama':
                $data = self::filterAgama($request, $query, $querytk);
                $export = new LaporanExport([
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all(),
                    'data_siswa' => $data_siswa,
                    'data_siswatk' => $data_siswatk,

                    // 'layakPIPCounts ' => $data['layakPIPCounts'],
                    'siswaCounts' => $data['siswaCounts'],
                    'siswaCountstk' => $data['siswaCountstk'],
                    'laporanType' =>'agama',
                ]);
                return Excel::download($export, 'laporan.xlsx');

            case 'penghasilan':
                $export = new LaporanExport([
                        'title' => 'Judul Laporan',
                        'sekolah' => Sekolah::all(),
                        'data_siswa' => $query->get(),
                        'laporanType' =>'penghasilan',
                ]);
                return Excel::download($export, 'laporan.xlsx');


            case 'kps':
                $data = self::filterKPS($request, $query);
                $export =  new LaporanExport ([
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all(),
                    'data_siswa' => $data_siswa,
                    'layakPIPCounts' => $data['layakPIPCounts'],
                    'laporanType' =>'kps',
                ]);
                return Excel::download($export, 'laporan.xlsx');

            case 'zonasi':
                $data = self::filterZonasi($request, $data_siswa);
                $export = new LapranExport([
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all(),
                    'data_siswa' => $query->get(),
                    'rataRataJarak' => $data,
                    'laporanType' =>'zonasi',
                ]);
                return Excel::download($export, 'laporan.xlsx');

            case 'jumlah_siswa':
                    $data = self::filterJS($request,$data_siswa_arsip,$data_siswa_arsipTK);
                    $export =  new LaporanExport([
                        'title' => 'Judul Laporan',
                        'sekolah' => Sekolah::all(),
                        'data_siswa' => $query->get(),
                        'data_siswatk' => $querytk->get(),
                        'data_siswa_arsip' => $query2->get(),
                        'data_siswa_arsipTK' => $queryTkArsip->get(),
                        'combined_data' => $data,
                        'laporanType' =>'jumlah_siswa',
                    ]);
                    return Excel::download($export, 'laporan.xlsx');    

            default:
            // dd($request->laporanType);
                abort(404);
        }
        abort(404);
    
     }

   

    private function filterAgama(Request $request, $data_siswa, $data_siswatk)
    {
        // Menghitung jumlah siswa berdasarkan jenis kelamin dan agama
        $siswaCounts = $data_siswa->select('JK', 'Agama', DB::raw('COUNT(*) as total'))
            ->groupBy('JK', 'Agama')
            ->get();

        // Menghitung jumlah siswa berdasarkan jenis kelamin dan agama
        $siswaCountstk = $data_siswatk->select('gender', 'agama', DB::raw('COUNT(*) as total'))
            ->groupBy('gender', 'agama')
            ->get();

        return view('laporan', [
            'siswaCounts' => $siswaCounts,
            'siswaCountstk' => $siswaCountstk,
        ]);
    }

    private function filterKPS(Request $request, $data_siswa)
    {
        if ($data_siswa->count() > 0) {
            $layakPIPCounts =  $data_siswa->select('Layak_PIP', DB::raw('COUNT(*) as total'))
                ->groupBy('Layak_PIP')
                ->get();

            return [
                'layakPIPCounts' => $layakPIPCounts
            ];
        } else {
            return [
                'layakPIPCounts' => []
            ];
        }
    }

    private function filterJenisKelamin(Request $request, $data_siswa, $data_siswatk)
    {
        // Menghitung jumlah laki-laki dan perempuan
        $jumlahLakiLaki = $data_siswa->where('JK', 'L')->count();
        $jumlahPerempuan = $data_siswa->where('JK', 'P')->count();

        // Menghitung jumlah laki-laki dan perempuan tk
        $jumlahLakiLaki2 = $data_siswatk->where('gender', '1')->count();
        $jumlahPerempuan2 = $data_siswatk->where('gender', '2')->count();

        // INI CODE BARU KARENA CODE SEBELUMNYA ITU PAKAI REQUEST TINGKATAN == TK JADI INI DIUBAH AGAR BISA TAMPIL 2 DIAGRAM
        
        // Menghitung total jumlah laki-laki dan perempuan untuk masing-masing data set
        $totalJLGeneral = $jumlahLakiLaki + $jumlahPerempuan;
        $totalJLTk = $jumlahLakiLaki2 + $jumlahPerempuan2;

        // Pastikan jumlah laki-laki dan perempuan selalu terdefinisi, bahkan jika data_siswa kosong
        if (!isset($jumlahLakiLaki)) {
            $jumlahLakiLaki = 0;
        }
        if (!isset($jumlahPerempuan)) {
            $jumlahPerempuan = 0;
        }

        return [
            'jumlah_cwo_general' => $jumlahLakiLaki,
            'jumlah_cwe_general' => $jumlahPerempuan,
            'total_general' => $totalJLGeneral,
            'jumlah_cwo_tk' => $jumlahLakiLaki2,
            'jumlah_cwe_tk' => $jumlahPerempuan2,
            'total_tk' => $totalJLTk,
        ];
    }

    private function filterZonasi(Request $request, $data_siswa)
    {
        $siswaJarak = [];
        foreach ($data_siswa as $siswa) {
            //if ($siswa->tingkatan == $tingkatan && $siswa->sekolah->NAMASEKOLAH == $namaSekolah && $siswa->Rombel_Set_Ini == $kelas) {
            $rombel = $siswa->Rombel_Set_Ini;
            $jarak = $siswa->Jarak_Rumah_ke_Sekolah;

            if (!isset($siswaJarak[$rombel])) {
                $siswaJarak[$rombel]['total'] = 0;
                $siswaJarak[$rombel]['count'] = 0;
            }

            $siswaJarak[$rombel]['total'] += $jarak;
            $siswaJarak[$rombel]['count']++;
        }

        $rataRataJarak = [];
        foreach ($siswaJarak as $rombel => $data) {
            $rataRataJarak[$rombel] = $data['total'] / $data['count'];
        }

        return $rataRataJarak;
    }

    private function filterPenghasilan(Request $request, $data_siswa)
    {
        return 'penghasilan';
    }

    private function filterJS(Request $request, $data_siswa_arsip, $data_siswa_arsipTK)
    {
        $query2 = Arship::with('sekolah');
        $queryTkArsip = Arsip_TK::with('sekolah');


        $namaSekolah = $request->input('namaSekolah');
        $tingkatan = $request->input('tingkatan');
        $detailKelas = $request->input('detailKelas');


        if ($namaSekolah) {
            $query2->whereHas('sekolah', function ($subQuery) use ($namaSekolah) {
                $subQuery->where('NAMASEKOLAH', $namaSekolah);
            });
            $queryTkArsip->whereHas('sekolah', function ($subQuery) use ($namaSekolah) {
                $subQuery->where('NAMASEKOLAH', $namaSekolah);
            });
        } elseif ($tingkatan) {
            $query2->whereHas('sekolah', function ($subQuery) use ($tingkatan) {
                $subQuery->where('NAMASEKOLAH', 'LIKE', $tingkatan . '%');
            });
            $queryTkArsip->whereHas('sekolah', function ($subQuery) use ($tingkatan) {
                $subQuery->where('NAMASEKOLAH', 'LIKE', $tingkatan . '%');
            });
        }

        if ($detailKelas || $request->hasAny(['kelasSD', 'kelasSMP', 'kelasTK'])) {
            $kelasType = $request->input('kelasSD') ?? $request->input('kelasSMP') ?? $request->input('kelasTK');
            $rombelSetIni = ($kelasType) ? $kelasType . $detailKelas : '%' . $detailKelas . '%';

            $query2->where(function ($subQuery) use ($rombelSetIni) {
                $subQuery->where('Rombel_Set_Ini', 'LIKE', $rombelSetIni);
            });

}

        $query2->get();
        $queryTkArsip->get();



        $data_js_arship = $query2
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as jumlah'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy('year')
            ->get();

        $data_js_arshipTK = $queryTkArsip
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as jumlah'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy('year')
            ->get();

        $combined_data = [];
        foreach ($data_js_arship as $key => $val) {
            $year = $val->year;
            $combined_data[$year]['arship'] = $val->jumlah;
        }

        foreach ($data_js_arshipTK as $key => $val) {
            $year = $val->year;
            $combined_data[$year]['tkk_arsip'] = $val->jumlah;
        }

        $temp = [[], []];
        foreach ($combined_data as $year => $data) {
            $years[] = $year;
            $arship_data[] = $data['arship'] ?? 0;
            $arshipTk_data[] = $data['tkk_arsip'] ?? 0;
        }

        return $combined_data;
    }
}

