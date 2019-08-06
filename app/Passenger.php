<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customers_id');
    }

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tours_id');
    }
}
