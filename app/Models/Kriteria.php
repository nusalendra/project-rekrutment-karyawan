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

    public function subkriteria() {
        return $this->hasMany(Subkriteria::class);
    }

    public function penilaian() {
        return $this->hasMany(Penilaian::class);
    }
}
