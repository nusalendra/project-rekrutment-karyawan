<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatans';
    protected $fillable = ['nama', 'deskripsi', 'benefit_pekerjaan', 'kriteria', 'gaji_awal', 'gaji_akhir'];
    protected $guarded = [];

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class);
    }

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class);
    }

    public function pengukuran()
    {
        return $this->hasMany(Pengukuran::class);
    }

    public function lowonganPekerjaan()
    {
        return $this->hasMany(LowonganPekerjaan::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
    
    public function dokumenPenilaian()
    {
        return $this->hasMany(DokumenPenilaian::class);
    }
}
