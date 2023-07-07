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
            $table->string('Tempat lahir')->length(100);
            $table->date('Tanggal Lahir');
            $table->integer('NIK',)->length(16);
            $table->string('Agama')->length(50);
            $table->string('Alamat')->length(100);
            $table->string('RT')->length(10);
            $table->string('RW')->length(10);
            $table->string('Dusun')->length(100);
            $table->string('Kelurahan')->length(100);
            $table->integer('kode pos')->length(5);
            $table->string('Jenis Tinggal')->length(100);
            $table->string('Alat Transportasi')->length(100);
            $table->string('Telepon')->length(12);
            $table->string('HP')->length(12);
            $table->string('Email')->length(100);
            $table->string('SKHUN')->length(16);
            $table->string('Penerima KPS')->length(5);
            $table->integer('No.KPS')->length(20);
            $table->string('Nama Ayah')->length(100);
            $table->integer('Tahun Lahir Ayah')->length(4);
            $table->string('Jenjang Pendidikan Ayah')->length(100);
            $table->string('Pekerjaan Ayah')->length(100);
            $table->string('Penghasilan Ayah')->length(100);
            $table->string('NIK Ayah')->length(16);
            $table->string('Nama ibu')->length(100);
            $table->integer('Tahun Lahir Ibu')->length(4);
            $table->string('Jenjang Pendidikan Ibu')->length(100);
            $table->string('Pekerjaan Ibu')->length(100);
            $table->string('Penghasilan Ibu')->length(100);
            $table->string('NIK Ibu')->length(16);
            $table->string('Nama wali')->length(100);
            $table->integer('Tahun Lahir wali')->length(4);
            $table->string('Jenjang Pendidikan wali')->length(100);
            $table->string('Pekerjaan wali')->length(100);
            $table->string('Penghasilan wali')->length(100);
            $table->string('NIK wali')->length(16);
            $table->string('Rombel Set Ini')->length(100);
            $table->string('No Peserta Ujian Nasional')->length(20);
            $table->string('No Seri Ijazah')->length(20);
            $table->string('Penerima KIP')->length(5);
            $table->string('Nomor KIP')->length(16);
            $table->string('Nama di KIP')->length(100);
            $table->string('No KKS')->length(16);
            $table->string('No Registrasi Akta Lahir')->length(100);
            $table->string('Bank')->length(100);
            $table->string('Nomor Rekening Bank')->length(50);
            $table->string('Rekening atas nama')->length(100);
            $table->string('Layak PIP')->length(5);
            $table->string('Alasan Layak PIP')->length(100);
            $table->string('Kebutuhan Khusus')->length(100);
            $table->string('Sekolah Asal')->length(100);
            $table->string('Anak ke-berapa')->length(2);
            $table->string('Lintang')->length(100);
            $table->string('bujur')->length(100);
            $table->string('No KK')->length(16);
            $table->integer('Berat Badan')->length(10);
            $table->integer('Tinggi badan')->length(10);
            $table->integer('Lingkar Kepala')->length(10);
            $table->integer('Jml. Saudara Kandung')->length(10);
            $table->integer('Jarak Rumah ke Sekolah (KM)')->length(100);
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
