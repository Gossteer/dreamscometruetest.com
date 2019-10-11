<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{

    protected $fillable = [ 'tours_id', 'customers_id', 'Preferential_Terms', 'Presence',
    ];

    protected $hidden = [

        'Amount_Children',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customers_id');
    }

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tours_id');
    }

    public function stock()
    {
        return $this->belongsTo('App\Stock','stock_id');
    }

    public function contracts_for_passenger()
    {
        return $this->hasMany('App\Contracts_for_passenger','contracts_for_passengers_id');
    }

    public function purchased_additional_services()
    {
        return $this->hasMany('App\Purchased_additional_services','passengers_id');
    }

}
