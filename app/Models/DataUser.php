<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;
    protected $table = 'data_users';
    protected $fillable = ['user_id', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'status', 'alamat_domisili', 'pendidikan_terakhir', 'IPK', 'pengalaman_kerja', 'pengalaman_organisasi', 'nomor_handphone', 'sosial_media', 'surat_lamaran_kerja', 'curriculum_vitae', 'ijazah_transkrip', 'pas_foto'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
