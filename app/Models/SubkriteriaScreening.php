<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubkriteriaScreening extends Model
{
    use HasFactory;
    protected $table = 'subkriteria_screenings';
    protected $fillable = ['kriteria_screening_id', 'nama', 'skor'];
    protected $guarded = [];

    public function kriteriaScreening() {
        return $this->belongsTo(KriteriaScreening::class);
    }
}
