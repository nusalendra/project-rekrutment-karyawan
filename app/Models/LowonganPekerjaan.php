<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganPekerjaan extends Model
{
    use HasFactory;
    protected $table = 'lowongan_pekerjaans';
    protected $fillable = ['periode_id', 'jabatan_id','tanggal_mulai', 'tanggal_akhir', 'kuota'];
    protected $guarded = [];

    public function pelamar() {
        return $this->hasMany(Pelamar::class);
    }

    public function periode() {
        return $this->belongsTo(Periode::class);
    }

    public function jabatan() {
        return $this->belongsTo(Jabatan::class);
    }

    public function tesPotensiAkademik() {
        return $this->hasMany(TesPotensiAkademik::class);
    }
}
