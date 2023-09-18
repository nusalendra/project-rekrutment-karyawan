<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilValidasi extends Model
{
    use HasFactory;
    protected $table = 'hasil_validasis';
    protected $fillable = ['pelamar_id', 'hasil_penilaian', 'tanggal_akhir'];
    protected $guarded = [];

    public function pelamar() {
        return $this->belongsTo(Pelamar::class);
    }
}
