<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesPotensiAkademik extends Model
{
    use HasFactory;
    protected $table = 'tes_potensi_akademiks';
    protected $fillable = ['lowongan_pekerjaan_id', 'nama', 'tanggal_waktu_mulai', 'tanggal_waktu_selesai', 'durasi'];
    protected $guarded = [];

    public function lowonganPekerjaan() {
        return $this->belongsTo(LowonganPekerjaan::class);
    }

    public function pertanyaanTesPotensiAkademik() {
        return $this->hasMany(PertanyaanTesPotensiAkademik::class, 'tes_potensi_akademik_id');
    }

    public function pelamarTesPotensiAkademik() {
        return $this->hasMany(PelamarTesPotensiAkademik::class);
    }
}
