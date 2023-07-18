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
        Schema::create('kirim', function (Blueprint $table) {
            // $table->integer('id_kirim')->primary()->increments();
            $table->increments('id_kirim')->start_from(1);
            $table->string('nama_file')->length(255);
            $table->string('ID')->length(5);
            $table->string('Komentar')->length(255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kirim');
    }
};
