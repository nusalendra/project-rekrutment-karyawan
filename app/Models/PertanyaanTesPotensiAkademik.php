<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanTesPotensiAkademik extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan_tes_potensi_akademiks';
    protected $fillable = ['tes_potensi_akademik_id' ,'pertanyaan', 'a', 'b', 'c', 'd', 'jawaban'];
    protected $guarded = [];

    public function TesPotensiAkademik() {
        return $this->belongsTo(TesPotensiAkademik::class);
    }
}
