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
        Schema::create('lowongan_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('periodes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('jabatan_id')->constrained('jabatans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->integer('kuota');
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
        Schema::dropIfExists('lowongan_pekerjaans');
    }
};
