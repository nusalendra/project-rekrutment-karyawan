<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesPotensiAkademik extends Model
{
    use HasFactory;
    protected $table = 'tes_potensi_akademiks';
    protected $fillable = ['lowongan_pekerjaan_id', 'nama', 'tanggal_waktu_mulai', 'tanggal_waktu_selesai'];
    protected $guarded = [];

    public function lowonganPekerjaan() {
        return $this->belongsTo(LowonganPekerjaan::class);
    }

    public function pertanyaanPostPotensiAkademik() {
        return $this->hasMany(PertanyaanTesPotensiAkademik::class);
    }
}
