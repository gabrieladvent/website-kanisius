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
            $table->integer('NOMOR_S')->primary()->length(4);
            $table->string('NAMA SEKOLAH')->length(100);
            $table->string('KECAMATAN')->length(100);
            $table->string('NAMA KEPALA SEKOLAH');
            $table->timestamps();
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
