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
            $table->text('pertanyaan');
            $table->text('a');
            $table->text('b');
            $table->text('c');
            $table->text('d');
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
