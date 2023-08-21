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
        Schema::create('TK_Siswa', function (Blueprint $table) {
            $table->string('no_siswa');
            $table->string('nama_siswa');
            $table->string('NIK')->nullable();
            $table->string('NIS')->nullable();
            $table->bigInteger('NISN')->primary();
            $table->string('gender')->nullable();
            $table->string('agama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('kota_lahir')->nullable();
            $table->string('nama_orang_tua')->nullable();
            $table->string('telepon')->nullable();
            $table->string('no_virtual')->nullable();
            $table->string('no_bank')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('keterangan_satu')->nullable();
            $table->string('keterangan_dua')->nullable();
            $table->string('no_cabang')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('status')->nullable();
            $table->string('email_orang_tua')->nullable();
            $table->integer('NOMOR_S')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TK_Siswa');
    }
};
