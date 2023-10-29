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
        Schema::create('subkriteria_screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_screening_id')->constrained('kriteria_screenings')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nama');
            $table->integer('skor');
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
        Schema::dropIfExists('subkriteria_screenings');
    }
};
