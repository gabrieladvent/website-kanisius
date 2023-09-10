<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HapusKirimanDibaca extends Command
{
    protected $signature = 'kirim:hapus_kiriman_dibaca';

    protected $description = 'Menghapus kiriman yang sudah dibaca setiap 6 bulan sekali';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Hapus file-file yang sesuai dari storage
        $filesToDelete = DB::table('kirim')->where('status', 2)->pluck('nama_file');
        
        foreach ($filesToDelete as $file) {
            Storage::delete('public/simpanFile/' . $file);
        }

        // Hapus kiriman yang memiliki status 2 (sudah dibaca) dari database
        DB::table('kirim')->where('status', 2)->delete();

        $this->info('Kiriman yang sudah dibaca dan file-file terkait berhasil dihapus.');
    } 
}
