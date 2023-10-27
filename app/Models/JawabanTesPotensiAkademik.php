<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanTesPotensiAkademik extends Model
{
    use HasFactory;
    protected $table = 'jawaban_tes_potensi_akademiks';
    protected $fillable = ['pelamar_tpa_id' ,'pertanyaan_tpa_id', 'pilihan_jawaban'];
    protected $guarded = [];

    public function pertanyaanTesPotensiAkademik() {
        return $this->belongsTo(PertanyaanTesPotensiAkademik::class, 'pertanyaan_tpa_id');
    }

    public function pelamarTesPotensiAkademik() {
        return $this->belongsTo(PelamarTesPotensiAkademik::class, 'pelamar_tpa_id');
    }
}
