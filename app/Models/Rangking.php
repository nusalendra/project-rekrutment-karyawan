<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rangking extends Model
{
    use HasFactory;
    protected $table = 'rangkings';
    protected $fillable = ['pelamar_id', 'hasil_penilaian', 'tanggal_akhir'];
    protected $guarded = [];

    public function pelamar() {
        return $this->hasOne(Pelamar::class);
    }
}
