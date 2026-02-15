<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
    protected $fillable =['age'];

    public function Appointments()
    {
        return $this->hasMany(Appointments::class);
    }


}
