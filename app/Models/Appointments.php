<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $guarded =[];

    public function availableTimes()
{
    return $this->belongsTo(AvailableTimes::class, 'available_time_id');
}



    public function patient(){
        return $this->belongsTo(Patient::class);

    }

    public function doctor()
    {
        return $this->hasOneThrough(
            Doctor::class,
            AvailableTimes::class,
            'id',
            'id',
            'available_time_id',
            'doctor_id'
        );
    }

}
