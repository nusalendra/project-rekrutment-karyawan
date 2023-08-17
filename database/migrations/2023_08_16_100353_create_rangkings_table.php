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
        Schema::create('rangkings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')->constrained('pelamars')->cascadeOnUpdate()->cascadeOnDelete();
            $table->double('hasil_penilaian');
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
        Schema::dropIfExists('rangkings');
    }
};
