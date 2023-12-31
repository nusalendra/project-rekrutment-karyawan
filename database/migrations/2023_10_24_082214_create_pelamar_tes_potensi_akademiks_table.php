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
        Schema::create('pelamar_tes_potensi_akademiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')->constrained('pelamars')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tes_potensi_akademik_id')->constrained('tes_potensi_akademiks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('total_pertanyaan')->nullable();
            $table->integer('total_jawaban_benar')->nullable();
            $table->integer('total_jawaban_salah')->nullable();
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
        Schema::dropIfExists('pelamar_tes_potensi_akademiks');
    }
};
