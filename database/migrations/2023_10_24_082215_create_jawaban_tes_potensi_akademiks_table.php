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
        Schema::create('jawaban_tes_potensi_akademiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_tpa_id')->constrained('pelamar_tes_potensi_akademiks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('pertanyaan_tpa_id')->constrained('pertanyaan_tes_potensi_akademiks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('pilihan_jawaban');
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
        Schema::dropIfExists('jawaban_tes_potensi_akademiks');
    }
};
