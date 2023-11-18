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
        Schema::create('data_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('kota_tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('agama')->nullable();
            $table->string('status')->nullable();
            $table->string('alamat_tinggal')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('IPK')->nullable();
            $table->string('pengalaman_kerja')->nullable();
            $table->string('pengalaman_organisasi')->nullable();
            $table->string('nomor_handphone')->nullable();
            $table->string('sosial_media')->nullable();
            $table->string('surat_lamaran_kerja')->nullable();
            $table->string('curriculum_vitae')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('pas_foto')->nullable();
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
        Schema::dropIfExists('data_users');
    }
};
