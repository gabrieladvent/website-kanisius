<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kirim;
use App\Models\Yayasan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

class YayasanController extends Controller
{
    public function kiriman($title)
    {
        return view('tablesekolah', compact('title'));
    }

    public function showUpdateForm($id)
    {
        $photo = yayasan::findOrFail($id);
        return view('akunYayasan', compact('photo'));
    }

    // Method untuk update foto tema
    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:png|max:2048',
        ]);

        $photo = Yayasan::find(1);

        if ($request->hasFile('photo')) {
            // Hapus foto lama dari storage jika ada
            File::delete(public_path('public/img/' . $photo->nama_foto));

            $file = $request->file('photo');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            // Simpan gambar ke 'public/storage/img'
            $file->StoreAs('/public/img', $filename);

            // Update informasi foto di database
            DB::beginTransaction();
            try {
                $photo->nama_foto = 'img/' . $filename;
                $photo->save();
                DB::commit();

                return back()->with('success', 'Foto berhasil diupdate!');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('gagal', 'Gagal mengupdate foto.');
            }
        }

        return redirect()->back()->with('gagal', 'Gagal mengupdate foto.');
    }

    // Method untuk upload foto tema
    public function upload(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/public/img', $filename); // Simpan gambar ke 'public/storage/img'

            // Buat entri baru di database untuk menyimpan informasi foto
            DB::beginTransaction();
            try {
                $photo = new Yayasan();
                $photo->nama_foto = 'img/' . $filename;
                $photo->save();
                DB::commit();

                return back()->with('success', 'Foto berhasil diupload!');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('gagal', 'Gagal mengupload foto.');
            }
        }
        return redirect()->back()->with('gagal', 'Gagal mengupload foto.');
    }

    // Method untuk menampilkan message di dashboard yayasan
    public function showNotifikasi($id, $title)
    {
        $idLoginNotif = '';
        $notification = DB::table('notifications')
                        ->select('data')
                        ->where('id', $id)
                        ->first();

        if ($notification) {
            $data = json_decode($notification->data, true);
            $idLoginNotif = $data['userLogin'];
        } else {
            // Notifikasi dengan ID tersebut tidak ditemukan
            return redirect()->back()->with('gagal', 'Data Tidak Ditemukan');
        }

        $notifikasi = Kirim::where('ID', $idLoginNotif)->with('user')->first();
        if (!$notifikasi) {
            return redirect()->route('profile')->with('gagal', 'Data tidak ditemukan');
        }
        // Pastikan file Excel ada pada path yang sesuai
        $excelPath = public_path('storage/simpanFile/' . $notifikasi->nama_file);

        // Baca data dari file Excel
        $spreadsheet = IOFactory::load($excelPath);
        $worksheet = $spreadsheet->getActiveSheet();
        $data_siswa = [];

        // Looping untuk membaca isi file Excel dan menyimpannya dalam array
        $startRow = 7;

        // Batasi jumlah baris yang ditampilkan menjadi 10
        $maxRows = 10;
        $currentRow = 1;

        foreach ($worksheet->getRowIterator($startRow) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $rowData = [];

            foreach ($cellIterator as $cell) {
                $rowData[] = $cell->getValue();
            }

            $data_siswa[] = $rowData;

            if ($currentRow === $maxRows) {
                break; // Hentikan perulangan setelah mencapai 10 baris
            }
            $currentRow++;
        }

        return view('tableSekolah', compact('notifikasi', 'data_siswa', 'title'));
    }

        public function showportal($title){
        $user = Auth::user();
        return view('portal', compact('title','user'));
        }

    // public function checkButton(Request $request)
    // {
    //      $user = Auth::user();

    //     $inputStartYear = $request->input('start-year');
    //     $inputStartMonth = $request->input('start-month');
    //     $inputStartDay = $request->input('start-day');
    //     $inputStartHour = $request->input('start-hour');
    //     $inputStartMinute = $request->input('start-minute');

    //     $inputEndYear = $request->input('end-year');
    //     $inputEndMonth = $request->input('end-month');
    //     $inputEndDay = $request->input('end-day');
    //     $inputEndHour = $request->input('end-hour');
    //     $inputEndMinute = $request->input('end-minute');

    //     $activeStartTime = Carbon::create($inputStartYear, $inputStartMonth, $inputStartDay, $inputStartHour, $inputStartMinute);
    //     $activeEndTime = Carbon::create($inputEndYear, $inputEndMonth, $inputEndDay, $inputEndHour, $inputEndMinute);

    //     $currentTime = Carbon::now();
    //      $disableButton = false;

    //      Session::put([
    //         'disableButton' => $disableButton,
    //         'activeStartTime' => $activeStartTime,
    //         'activeEndTime' => $activeEndTime,
    //         'currentTime' => $currentTime,
    //     ]);

      

    //     if ($currentTime < $activeStartTime || $currentTime > $activeEndTime) {
    //         $disableButton = true;
    //     }
        
    //     // dd($disableButton);

    //      return redirect()->route('upload-view',['slug' => $user->slug])->with([ 
    //         'activeStartTime' => $activeStartTime,
    //          'activeEndTime' => $activeEndTime,
    //          'currentTime' => $currentTime,
    //         ]);

            
    
    //         // return redirect()->route('upload-view',[
    //         //     'disableButton' => $disableButton,
    //         //     'slug' => 'slug',
    //         //     // 'title' => 'title',
    //         //     // 'user' => $user,
    //         //     'activeStartTime' => $activeStartTime,
    //         //     'activeEndTime' => $activeEndTime,
    //         //     'currentTime' => $currentTime,
    //         // ]);
    //         }

    

}
