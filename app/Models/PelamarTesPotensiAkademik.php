<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelamarTesPotensiAkademik extends Model
{
    use HasFactory;
    protected $table = 'pelamar_tes_potensi_akademiks';
    protected $fillable = ['pelamar_id' ,'tes_potensi_akademik_id'];
    protected $guarded = [];

    public function pelamar() {
        return $this->belongsTo(Pelamar::class);
    }

    public function tesPotensiAkademik() {
        return $this->belongsTo(TesPotensiAkademik::class);
    }

    public function jawabanTesPotensiAkademik() {
        return $this->hasMany(JawabanTesPotensiAkademik::class, 'pelamar_tpa_id');
    }
}
