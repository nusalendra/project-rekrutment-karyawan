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
            $table->string('status_tes')->nullable();
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
