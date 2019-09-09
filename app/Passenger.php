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
}
