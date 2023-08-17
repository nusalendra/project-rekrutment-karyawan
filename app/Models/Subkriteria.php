<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    use HasFactory;
    protected $table = 'subkriterias';
    protected $fillable = ['kriteria_id', 'nama', 'min', 'max', 'nilai'];
    protected $guarded = [];

    public function kriteria() {
        return $this->belongsTo(Kriteria::class);
    }

    public function penilaian() {
        return $this->hasMany(Penilaian::class);
    }
}
