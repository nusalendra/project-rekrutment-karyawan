<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanTesPotensiAkademik extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan_tes_potensi_akademiks';
    protected $fillable = ['tes_potensi_akademik_id', 'pertanyaan', 'file_input_pertanyaan', 'pilihan_a', 'file_input_pilihan_a', 'pilihan_b', 'file_input_pilihan_b', 'pilihan_c', 'file_input_pilihan_c', 'pilihan_d', 'file_input_pilihan_d', 'jawaban'];
    protected $guarded = [];

    public function TesPotensiAkademik()
    {
        return $this->belongsTo(TesPotensiAkademik::class, 'tes_potensi_akademik_id');
    }

    public function jawabanTesPotensiAkademik()
    {
        return $this->hasMany(JawabanTesPotensiAkademik::class, 'pertanyaan_tpa_id');
    }
}
