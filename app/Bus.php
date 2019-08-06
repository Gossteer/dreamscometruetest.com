<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    public function tour()
    {
        return $this->hasMany('App\Tour', 'buses_id');
    }
}
