<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dob',
        'gender',
        'address',
        'phone',
    ];

    // Quan hệ: bệnh nhân thuộc về một user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Quan hệ: bệnh nhân có nhiều lịch hẹn
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}
