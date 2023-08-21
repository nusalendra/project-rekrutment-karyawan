<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatans';
    protected $fillable = ['nama'];
    protected $guarded = [];

    public function kriteria() {
        return $this->hasMany(Kriteria::class);
    }

    public function subkriteria() {
        return $this->hasMany(Subkriteria::class);
    }

    public function lowonganPekerjaan() {
        return $this->hasMany(LowonganPekerjaan::class);
    }

    public function penilaian() {
        return $this->hasMany(Penilaian::class);
    }
}