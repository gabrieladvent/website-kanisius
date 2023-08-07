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
        Schema::create('siswa', function (Blueprint $table) {
            $table->string('Nama');
            $table->string('NIPD')->nullable();
            $table->string('JK')->nullable();
            $table->bigInteger('NISN')->primary();
            $table->string('Tempat_lahir')->nullable();
            $table->date('Tanggal_Lahir')->nullable();
            $table->string('NIK',)->nullable();
            $table->string('Agama')->nullable();
            $table->string('Alamat')->nullable();
            $table->string('RT')->nullable();
            $table->string('RW')->nullable();
            $table->string('Dusun')->nullable();
            $table->string('Kelurahan')->nullable();
            $table->string('Kecamatan')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('Jenis_Tinggal')->nullable();
            $table->string('Alat_Transportasi')->nullable();
            $table->string('Telepon')->nullable();
            $table->string('HP')->nullable();
            $table->string('Email')->nullable();
            $table->string('SKHUN')->nullable();
            $table->string('Penerima_KPS')->nullable();
            $table->string('No_KPS')->nullable();
            $table->string('Nama_Ayah')->nullable();
            $table->string('Tahun_Lahir_Ayah')->nullable();
            $table->string('Jenjang_Pendidikan_Ayah')->nullable();
            $table->string('Pekerjaan_Ayah')->nullable();
            $table->string('Penghasilan_Ayah')->nullable();
            $table->string('NIK_Ayah')->nullable();
            $table->string('Nama_ibu')->nullable();
            $table->string('Tahun_Lahir_Ibu')->nullable();
            $table->string('Jenjang_Pendidikan_Ibu')->nullable();
            $table->string('Pekerjaan_Ibu')->nullable();
            $table->string('Penghasilan_Ibu')->nullable();
            $table->string('NIK_Ibu')->nullable();
            $table->string('Nama_wali')->nullable();
            $table->string('Tahun_Lahir_wali')->nullable();
            $table->string('Jenjang_Pendidikan_wali')->nullable();
            $table->string('Pekerjaan_wali')->nullable();
            $table->string('Penghasilan_wali')->nullable();
            $table->string('NIK_wali')->nullable();
            $table->string('Rombel_Set_Ini')->nullable();
            $table->string('No_Peserta_Ujian_Nasional')->nullable();
            $table->string('No_Seri_Ijazah')->nullable();
            $table->string('Penerima_KIP')->nullable();
            $table->string('Nomor_KIP')->nullable();
            $table->string('Nama_di_KIP')->nullable();
            $table->string('No_KKS')->nullable();
            $table->string('No_Registrasi_Akta_Lahir')->nullable();
            $table->string('Bank')->nullable();
            $table->string('Nomor_Rekening_Bank')->nullable();
            $table->string('Rekening_atas_nama')->nullable();
            $table->string('Layak_PIP')->nullable();
            $table->string('Alasan_Layak_PIP')->nullable();
            $table->string('Kebutuhan_Khusus')->nullable();
            $table->string('Sekolah_Asal')->nullable();
            $table->string('Anak_ke_berapa')->nullable();
            $table->string('Lintang')->nullable();
            $table->string('bujur')->nullable();
            $table->string('No_KK')->nullable();
            $table->string('Berat_Badan')->nullable();
            $table->string('Tinggi_badan')->nullable();
            $table->string('Lingkar_Kepala')->nullable();
            $table->string('Jml_Saudara_Kandung')->nullable();
            $table->string('Jarak_Rumah_ke_Sekolah')->nullable();
            $table->integer('NOMOR_S')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
