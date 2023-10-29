<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaScreening extends Model
{
    use HasFactory;
    protected $table = 'kriteria_screenings';
    protected $fillable = ['nama', 'tipe', 'bobot'];
    protected $guarded = [];

    public function subkriteriaScreening()
    {
        return $this->hasMany(SubkriteriaScreening::class);
    }
}
