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
        Schema::create('sekolah_kanisius', function (Blueprint $table) {
            $table->integer('nomor_sekolah')->length(4);
            $table->string('nama_sekolah')->length(100);
            $table->string('kecamatan')->length(100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah_kanisius');
    }
};
