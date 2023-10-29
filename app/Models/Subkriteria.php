<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    use HasFactory;
    protected $table = 'subkriterias';
    protected $fillable = ['jabatan_id' ,'kriteria_id', 'nama', 'bobot_kriteria_per_subkriteria'];
    protected $guarded = [];

    public function jabatan() {
        return $this->belongsTo(Jabatan::class);
    }

    public function kriteria() {
        return $this->belongsTo(Kriteria::class);
    }

    public function pengukuran() {
        return $this->hasMany(Pengukuran::class);
    }

    public function penilaian() {
        return $this->hasMany(Penilaian::class);
    }

    public function dokumenPendukung() {
        return $this->hasMany(DokumenPendukung::class);
    }

   
}
