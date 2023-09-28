<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriterias';
    protected $fillable = ['jabatan_id', 'nama', 'tipe', 'bobot'];
    protected $guarded = [];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class);
    }

    public function pengukuran()
    {
        return $this->hasMany(Pengukuran::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
