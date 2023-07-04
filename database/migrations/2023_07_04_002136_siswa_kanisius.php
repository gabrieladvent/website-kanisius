<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa_kanisius', function (Blueprint $table) {
            $table->integer('nipd')->primary();
            $table->string('nama_siswa')->length(500);
            $table->string('jenis_kelamin')->length(100);
            $table->integer('nisn')->length(10);
            $table->string('tempat_lahir')->length(100);
            $table->date('tanggal_lahir');
            $table->integer('nik_siswa',)->length(16);
            $table->string('agama')->length(50);
            $table->string('nama_jalan')->length(100);
            $table->string('rt_rw')->length(10);
            $table->string('dusun')->length(100);
            $table->string('kelurahan')->length(100);
            $table->integer('kode_pos')->length(5);
            $table->string('tinggal_bersama')->length(100);
            $table->string('transportsi')->length(100);
            $table->string('no_hp')->length(12);
            $table->string('email')->length(100);
            $table->string('skhun')->length(16);
            $table->string('penerima_kps')->length(5);
            $table->integer('nomor_kps')->length(20);
            $table->string('nama_ayah')->length(100);
            $table->integer('tahun_lahir_ayah')->length(4);
            $table->string('jenjang_pendidikan_ayah')->length(100);
            $table->string('pekerjaan_ayah')->length(100);
            $table->string('penghasilan_ayah')->length(100);
            $table->string('nik_ayah')->length(16);
            $table->string('nama_ibu')->length(100);
            $table->integer('tahun_lahir_ibu')->length(4);
            $table->string('jenjang_pendidikan_ibu')->length(100);
            $table->string('pekerjaan_ibu')->length(100);
            $table->string('penghasilan_ibu')->length(100);
            $table->string('nik_ibu')->length(16);
            $table->string('nama_wali')->length(100);
            $table->integer('tahun_lahir_wali')->length(4);
            $table->string('jenjang_pendidikan_wali')->length(100);
            $table->string('pekerjaan_wali')->length(100);
            $table->string('penghasilan_wali')->length(100);
            $table->string('nik_wali')->length(16);
            $table->string('rombel_sekarang')->length(100);
            $table->string('nomor_seri_ijasah')->length(20);
            $table->string('penerima_kip')->length(5);
            $table->string('nomor_kip')->length(16);
            $table->string('nama_kip')->length(100);
            $table->string('nomor_kks')->length(16);
            $table->string('nomor_registrasi_akta')->length(100);
            $table->string('bank')->length(100);
            $table->string('nomor_rekening_bank')->length(50);
            $table->string('nama_rekening')->length(100);
            $table->string('layak_pip')->length(5);
            $table->string('alasan_pip')->length(100);
            $table->string('kebutuhan_kusus')->length(100);
            $table->string('sekolah_asal')->length(100);
            $table->string('anak_ke')->length(2);
            $table->string('lintang')->length(100);
            $table->string('bujur')->length(100);
            $table->string('nomor_kk')->length(16);
            $table->integer('berat_badan')->length(10);
            $table->integer('tinggi_badan')->length(10);
            $table->integer('lingkar_kepala')->length(10);
            $table->integer('jumlah_saudara')->length(10);
            $table->integer('jarak_rumah')->length(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_kanisius');
    }
};
