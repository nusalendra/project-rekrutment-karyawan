<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPenilaian extends Model
{
    use HasFactory;
    protected $table = 'dokumen_penilaians';
    protected $fillable = ['pelamar_id', 'jabatan_id', 'kriteria_id', 'dokumen'];
    protected $guarded = [];

    public function pelamar() {
        return $this->belongsTo(Pelamar::class);
    }

    public function jabatan() {
        return $this->belongsTo(Jabatan::class);
    }

    public function kriteria() {
        return $this->belongsTo(Kriteria::class);
    }
}
