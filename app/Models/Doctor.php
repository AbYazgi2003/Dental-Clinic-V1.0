<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    protected $fillable = ['bio','department_id','phone','img','name'];

    public function department()
{
    return $this->belongsTo(Department::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
public function AvailableTimes()
    {
        return $this->hasMany(AvailableTimes::class);
    }

    // علاقة الدكتور مع المواعيد المحجوزة (من خلال المواعيد المتاحة)
    public function reservedAppointments()
    {
        return $this->hasManyThrough(
            Appointments::class,
            AvailableTimes::class,
            'doctor_id',
            'available_time_id',
            'id',
            'id'
        );
    }

    // علاقة لجلب المواعيد المحجوزة مع تفاصيلها
    public function getReservedAppointmentsWithDetails()
    {
        return Appointments::whereHas('availableTime', function($query) {
            $query->where('doctor_id', $this->id);
        })->with(['availableTime', 'patient'])->get();
    }
}

