<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    public function passenger()
    {
        return $this->hasOne('App\Passenger', 'passengers_id');
    }

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tours_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}
