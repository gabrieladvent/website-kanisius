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
            $table->string('Nama')->length(500);
            $table->integer('NIPD')->length(10);
            $table->string('JK')->length(10);
            $table->integer('NISN')->primary()->length(10);
            $table->string('Tempat_lahir')->length(100);
            $table->date('Tanggal_Lahir');
            $table->integer('NIK',)->length(16);
            $table->string('Agama')->length(50);
            $table->string('Alamat')->length(100);
            $table->string('RT')->length(10);
            $table->string('RW')->length(10);
            $table->string('Dusun')->length(100);
            $table->string('Kelurahan')->length(100);
            $table->string('Kecamatan')->length(100);
            $table->integer('kode_pos')->length(5);
            $table->string('Jenis_Tinggal')->length(100);
            $table->string('Alat_Transportasi')->length(100);
            $table->string('Telepon')->length(12);
            $table->integer('HP')->length(12);
            $table->string('Email')->length(100);
            $table->integer('SKHUN')->length(16);
            $table->string('Penerima_KPS')->length(5);
            $table->integer('No_KPS')->length(20);
            $table->string('Nama_Ayah')->length(100);
            $table->integer('Tahun_Lahir_Ayah')->length(4);
            $table->string('Jenjang_Pendidikan_Ayah')->length(100);
            $table->string('Pekerjaan_Ayah')->length(100);
            $table->string('Penghasilan_Ayah')->length(100);
            $table->integer('NIK_Ayah')->length(16);
            $table->string('Nama_ibu')->length(100);
            $table->integer('Tahun_Lahir_Ibu')->length(4);
            $table->string('Jenjang_Pendidikan_Ibu')->length(100);
            $table->string('Pekerjaan_Ibu')->length(100);
            $table->string('Penghasilan_Ibu')->length(100);
            $table->integer('NIK_Ibu')->length(16);
            $table->string('Nama_wali')->length(100);
            $table->integer('Tahun_Lahir_wali')->length(4);
            $table->string('Jenjang_Pendidikan_wali')->length(100);
            $table->string('Pekerjaan_wali')->length(100);
            $table->string('Penghasilan_wali')->length(100);
            $table->string('NIK_wali')->length(16);
            $table->string('Rombel_Set_Ini')->length(100);
            $table->integer('No_Peserta_Ujian_Nasional')->length(20);
            $table->string('No_Seri_Ijazah')->length(20);
            $table->string('Penerima_KIP')->length(5);
            $table->integer('Nomor_KIP')->length(16);
            $table->string('Nama_di_KIP')->length(100);
            $table->integer('No_KKS')->length(16);
            $table->string('No_Registrasi_Akta_Lahir')->length(100);
            $table->string('Bank')->length(100);
            $table->string('Nomor_Rekening_Bank')->length(50);
            $table->string('Rekening_atas_nama')->length(100);
            $table->string('Layak_PIP')->length(5);
            $table->string('Alasan_Layak_PIP')->length(100);
            $table->string('Kebutuhan_Khusus')->length(100);
            $table->string('Sekolah_Asal')->length(100);
            $table->string('Anak_ke_berapa')->length(2);
            $table->string('Lintang')->length(100);
            $table->string('bujur')->length(100);
            $table->string('No_KK')->length(16);
            $table->integer('Berat_Badan')->length(10);
            $table->integer('Tinggi_badan')->length(10);
            $table->integer('Lingkar_Kepala')->length(10);
            $table->integer('Jml_Saudara_Kandung')->length(10);
            $table->integer('Jarak_Rumah_ke_Sekolah')->length(100);
            $table->integer('NOMOR_S')->length(4);
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
