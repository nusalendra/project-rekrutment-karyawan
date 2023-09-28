<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaians';
    protected $fillable = ['pelamar_id', 'periode_id', 'jabatan_id', 'kriteria_id', 'subkriteria_id', 'nilai_normalisasi'];
    protected $guarded = [];

    public function pelamar() {
        return $this->belongsTo(Pelamar::class);
    }

    public function periode() {
        return $this->belongsTo(Periode::class);
    }

    public function jabatan() {
        return $this->belongsTo(Jabatan::class);
    }

    public function kriteria() {
        return $this->belongsTo(Kriteria::class);
    }

    public function subkriteria() {
        return $this->belongsTo(Subkriteria::class);
    }

    public function pengukuran() {
        return $this->belongsTo(Pengukuran::class);
    }
}
