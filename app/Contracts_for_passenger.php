<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contracts_for_passenger extends Model
{
    protected $fillable = [
        'Childrens', 'Gorwns', 'Prepayment',
    ];

    public function passenger()
    {
        return $this->hasMany('App\Passenger','contracts_for_passengers_id');
    }
}
