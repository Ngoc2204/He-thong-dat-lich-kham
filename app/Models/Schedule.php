<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'dentist_id','weekday','start_time','end_time','slot_minutes'
    ];

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }
}
