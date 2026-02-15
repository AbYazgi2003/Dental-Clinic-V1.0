<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailableTimes extends Model
{
    protected $guarded =[];

    public function doctor()
{
    return $this->belongsTo(Doctor::class);
}

public function appointments() 
{
    return $this->hasOne(Appointments::class, 'available_time_id');
}


}
