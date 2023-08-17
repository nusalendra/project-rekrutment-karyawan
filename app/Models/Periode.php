<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periodes';
    protected $fillable = ['nama', 'tanggal_mulai', 'tanggal_akhir'];
    protected $guarded = [];

    public function penilaian() {
        return $this->hasMany(Penilaian::class);
    }

    public function lowonganPekerjaan() {
        return $this->hasMany(LowonganPekerjaan::class);
    }
}
