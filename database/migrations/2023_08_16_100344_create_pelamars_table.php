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
        Schema::create('pelamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lowongan_pekerjaan_id')->constrained('lowongan_pekerjaans');
            $table->string('nama_lengkap')->nullable();
            $table->string('TTL')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('nomor_handphone')->nullable();
            $table->string('agama')->nullable();
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
        Schema::dropIfExists('pelamars');
    }
};
