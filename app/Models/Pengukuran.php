<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengukuran extends Model
{
    use HasFactory;
    protected $table = 'pengukurans';
    protected $fillable = ['jabatan_id', 'kriteria_id', 'subkriteria_id', 'nama', 'skor'];
    protected $guarded = [];

    public function jabatan()
    {
       return $this->belongsTo(Jabatan::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class);
    }
}
