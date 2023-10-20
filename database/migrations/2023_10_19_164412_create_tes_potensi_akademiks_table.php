<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tes_potensi_akademiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lowongan_pekerjaan_id')->constrained('lowongan_pekerjaans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nama');
            $table->dateTime('tanggal_waktu_mulai');
            $table->dateTime('tanggal_waktu_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tes_potensi_akademiks');
    }
};
