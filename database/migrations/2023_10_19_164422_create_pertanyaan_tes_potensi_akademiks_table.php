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
        Schema::create('pertanyaan_tes_potensi_akademiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tes_potensi_akademik_id')->constrained('tes_potensi_akademiks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('pertanyaan')->nullable();
            $table->string('file_input_pertanyaan')->nullable();
            $table->text('pilihan_a')->nullable();
            $table->string('file_input_pilihan_a')->nullable();
            $table->text('pilihan_b')->nullable();
            $table->string('file_input_pilihan_b')->nullable();
            $table->text('pilihan_c')->nullable();
            $table->string('file_input_pilihan_c')->nullable();
            $table->text('pilihan_d')->nullable();
            $table->string('file_input_pilihan_d')->nullable();
            $table->text('jawaban');
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
        Schema::dropIfExists('pertanyaan_tes_potensi_akademiks');
    }
};
