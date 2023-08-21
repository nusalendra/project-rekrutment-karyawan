<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;
    protected $table = 'pelamars';
    protected $fillable = ['user_id', 'lowongan_pekerjaan_id', 'TTL', 'jenis_kelamin', 'nomor_handphone', 'agama'];
    protected $guarded = [];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function lowonganPekerjaan() {
        return $this->belongsTo(LowonganPekerjaan::class);
    }

    public function penilaian() {
        return $this->hasMany(Penilaian::class);
    }
}