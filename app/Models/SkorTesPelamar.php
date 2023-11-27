<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkorTesPelamar extends Model
{
    use HasFactory;
    protected $table = 'skor_tes_pelamars';
    protected $fillable = ['pelamar_id' ,'skor_tes'];
    protected $guarded = [];

    public function pelamar() {
        return $this->belongsTo(Pelamar::class);
    }
}
