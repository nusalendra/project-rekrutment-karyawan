<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;
    protected $table = 'pelamars';
    protected $fillable = ['user_id', 'lowongan_pekerjaan_id', 'status_lamaran'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lowonganPekerjaan()
    {
        return $this->belongsTo(LowonganPekerjaan::class);
    }
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function hasilValidasi()
    {
        return $this->hasOne(HasilValidasi::class);
    }

    public function dokumenPenilaian()
    {
        return $this->hasMany(DokumenPenilaian::class);
    }
}
