<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\User as user;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa_Tk as Tk_Siswa;
use App\Models\Arship as arship;
use App\Models\Arsip_Tk;
use Alert;

class LaporanController extends Controller
{
    public function laporan_hasil(Request $request)
    {
        $tipeLaporan = $request->laporanType;
        $tingkatan = $request->tingkatan;
        $namasekolah = $request->namaSekolah;
        $kelasTK = $request->input('kelasTK', 'all');
        $kelasSD = $request->kelasSD;
        $kelasSMP = $request->kelasSMP;
        $detail = $request->detailKelas;
        // dd($request->all());
        $sekolahname = '';
        $queryKelas = '';

        if ($tipeLaporan == 'agama') {
            $user = Auth::user();

            // Bangun kueri dasar untuk mengambil model Siswa dengan relasi sekolah yang sudah dimuat eager
            $query = Siswa::with('sekolah')->get();
            $querytk = Tk_Siswa::with('sekolah')->get();

            // Filter data siswa berdasarkan kriteria yang dipilih
            if (strpos($namasekolah, 'SD') === 0) {
                // dd('sd');
                $sekolahname = Sekolah::where('NAMASEKOLAH', $namasekolah)->first();

                if ($kelasSD && $detail) {
                    $rombelSetIni = $kelasSD . '' . $detail;
                    $queryKelas = Siswa::where('Rombel_Set_Ini', $rombelSetIni);
                } else if ($kelasSD) {
                    $queryKelas = Siswa::where('Rombel_Set_Ini', 'LIKE', '%' . $kelasSD . '%')->get();
                }
            } elseif (strpos($namasekolah, 'TK') === 0) {
                // dd('tk');
                $sekolahname = Sekolah::where('NAMASEKOLAH', $namasekolah)->first();
            } elseif (strpos($namasekolah, 'SMP') === 0) {
                // dd('smp');
                $sekolahname = Sekolah::where('NAMASEKOLAH', $namasekolah)->first();
                if ($kelasSMP && $detail) {
                    $rombelSetIni = $kelasSMP . '' . $detail;
                    $queryKelas = Siswa::where('Rombel_Set_Ini', $rombelSetIni);
                } else if ($kelasSMP) {
                    $queryKelas = Siswa::where('Rombel_Set_Ini', 'LIKE', '%' . $kelasSMP . '%')->get();
                }
            } else {
                dd('data invalid');
            }

            $sekolah = Sekolah::all();

            dd($query, $querytk, $queryKelas, $sekolahname, $sekolah, $user);
            return view('laporan', compact(
                'query',
                'querytk',
                'queryKelas',
                'sekolahname',
                'sekolah',
                'user'
            ));
        } elseif ($tipeLaporan == 'jk') {
            dd('jk');
        } elseif ($tipeLaporan == 'penghasilan') {
            dd('penghasilan');
        } elseif ($tipeLaporan == 'kps') {
            dd('kps');
        } elseif ($tipeLaporan == 'zonasi') {
            dd('zonasi');
        } elseif ($tipeLaporan == 'js') {
            dd('js');
        } else {
            dd('salah filter');
        }
    }

    public function laporan($title)
    {
        $user = Auth::user();
        $siswa = Siswa::all();
        $siswaTK = TK_Siswa::all();
        $data_siswa = $siswa->load('sekolah');
        $data_siswatk = $siswaTK->load('sekolah');
        $data_siswa = $data_siswa->concat($siswaTK->load('sekolah'));
        $sekolah = Sekolah::all();
        return view('laporan', compact('data_siswa', 'sekolah', 'title', 'user', 'data_siswatk'));
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
    public function cetakLaporan(Request $request, $title)
    {
        return $request->all();
    }



    public function filter(Request $request)
    {
        $request->validate([
            'laporanType' => 'required'
        ]);
        $query = Siswa::with('sekolah');
        $querytk = Tk_Siswa::with('sekolah');
        if ($request->has('namaSekolah')) {
            $query = $query->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', $request->namaSekolah);
            });
            $querytk = $querytk->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', $request->namaSekolah);
            });
        } else if ($request->has('tingkatan')) {
            $query = $query->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', 'LIKE', $request->tingkatan . '%');
            });
        }

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
                    if ($detailKelas) {
                        $rombelSetIni = $selectedKelas . $detailKelas;
                    } else {
                        $rombelSetIni = $selectedKelas . '%';
                    }
                } else {
                    $rombelSetIni = '%' . $detailKelas . '%';
                }

                $query->where('Rombel_Set_Ini', 'LIKE', $rombelSetIni);
            });
        }

        $data_siswa = $query->get();
        $data_siswatk = $querytk->get();

        // if ($data_siswatk > $data_siswa) {
        //     if ($request->tingkatan === 'TK') {
        //         $data_siswa = $data_siswatk;
        //     }
        // }

        switch ($request->laporanType) {
            case 'jk':
                $data = self::filterJenisKelamin($request, $data_siswa, $data_siswatk);
                return view('laporan', [
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all(),
                    'data_siswa' => $data_siswa,
                    'jumlahLakiLaki' => $data['jumlah_cwo'],
                    'jumlahPerempuan' => $data['jumlah_cwe'],
                    'totalJL' => $data['total']
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
            case 'js':
                $data = self::filterJS($request, $data_siswa, $data_siswatk);
                return view('laporan.index', [
                    'title' => 'Judul Laporan',
                    'sekolah' => Sekolah::all(),
                    'data_siswa' => $query->get(),
                    'data_js' => $data
                ]);

            default:
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
    // private function filterKPS(Request $request, $data_siswa)
    // {
    //     $layakPIPCounts =  $data_siswa->select('Layak_PIP', DB::raw('COUNT(*) as total'))
    //         ->groupBy('Layak_PIP')
    //         ->get();

    //         return view('laporan', [
    //             'layakPIPCounts' => $layakPIPCounts
    //         ]);
    // }
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
        // Menghitung total jumlah laki-laki dan perempuan

        if ($request->tingkatan === 'TK') {
            $totalJL = $jumlahLakiLaki2 + $jumlahPerempuan2;
        } else if ($request->tingkatan === 'SD' || $request->tingkatan === 'SMP') {
            $totalJL = $jumlahLakiLaki + $jumlahPerempuan;
        } else {
            $totalJL = $jumlahLakiLaki + $jumlahPerempuan + $jumlahLakiLaki2 + $jumlahPerempuan2;
        }

        // Pastikan jumlah laki-laki dan perempuan selalu terdefinisi, bahkan jika data_siswa kosong
        if (!isset($jumlahLakiLaki)) {
            $jumlahLakiLaki = 0;
        }
        if (!isset($jumlahPerempuan)) {
            $jumlahPerempuan = 0;
        }

        if ($request->tingkatan === 'TK') {
            $jumlahLakiLaki = isset($jumlahLakiLaki) || isset($jumlahLakiLaki2) ? $jumlahLakiLaki2 : 0;
            $jumlahPerempuan = isset($jumlahPerempuan) || isset($$jumlahPerempuan2) ? $jumlahPerempuan2 : 0;
        } else if ($request->tingkatan === 'SD' || $request->tingkatan === 'SMP') {
            $jumlahLakiLaki = isset($jumlahLakiLaki) || isset($jumlahLakiLaki2) ? $jumlahLakiLaki : 0;
            $jumlahPerempuan = isset($jumlahPerempuan) || isset($$jumlahPerempuan2) ? $jumlahPerempuan : 0;
        } else {
            $jumlahLakiLaki = isset($jumlahLakiLaki) || isset($jumlahLakiLaki2) ? $jumlahLakiLaki + $jumlahLakiLaki2 : 0;
            $jumlahPerempuan = isset($jumlahPerempuan) || isset($$jumlahPerempuan2) ? $jumlahPerempuan + $jumlahPerempuan2 : 0;
        }
        return [
            'jumlah_cwo' => $jumlahLakiLaki,
            'jumlah_cwe' => $jumlahPerempuan,
            'total' => $totalJL
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



    private function filterJS(Request $request, $data_siswa, $data_siswatk)
    {
        $dataArsipSiswa = Arship::with('sekolah');
        $dataArsipTk = Arsip_Tk::with('sekolah');

        if ($request->has('namaSekolah')) {
            $dataArsipSiswa  =  $dataArsipSiswa->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', $request->namaSekolah);
            });
            $dataArsipTk =   $dataArsipTk->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', $request->namaSekolah);
            });
        } else if ($request->has('tingkatan')) {
            $dataArsipSiswa = $dataArsipSiswa->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', 'LIKE', $request->tingkatan . '%');
            });
        } else if ($request->has('tingkatan')) {
            $dataArsipTk = $dataArsipTk->whereHas('sekolah', function ($subQuery) use ($request) {
                $subQuery->where('NAMASEKOLAH', 'LIKE', $request->tingkatan . '%');
            });
        }

        if ($request->has('detailKelas') || $request->hasAny(['kelasSD', 'kelasSMP', 'kelasTK'])) {
            $dataArsipSiswa->where(function ($query) use ($request) {
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
                    if ($detailKelas) {
                        $rombelSetIni = $selectedKelas . $detailKelas;
                    } else {
                        $rombelSetIni = $selectedKelas . '%';
                    }
                } else {
                    $rombelSetIni = '%' . $detailKelas . '%';
                }

                $query->where('Rombel_Set_Ini', 'LIKE', $rombelSetIni);
            });
        }
        $data_siswa_Arship =  $dataArsipSiswa->get();
        // $data_siswatk_Arship =  $dataArsipSiswa->get();


        $data_siswa = DB::table('siswa')->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('count(*) as jumlah')
        )->groupBy('year')
            ->orderByDesc('year')
            ->get();

        $data_siswa_Arship  = DB::table('arship')->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('count(*) as jumlah')
        )->groupBy('year')
            ->orderByDesc('year')
            ->get();

        // Menggabungkan data siswa dan data arship
        $data_siswa_combined = $data_siswa->concat($data_siswa_Arship);

        // Mengubah data menjadi koleksi dengan grup tahun dan jumlah siswa
        $data_js_siswa_combined = $data_siswa_combined->groupBy(function ($item) {
            return $item->year;
        })->map(function ($group) {
            return [
                'year' => $group[0]->year,
                'jumlah' => $group->sum('jumlah')
            ];
        });

        $data_js = $data_js_siswa_combined;

        return $data_js;
    }
}
