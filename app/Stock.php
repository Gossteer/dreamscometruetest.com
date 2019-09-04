<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'Name_Stock', 'Stock_Price',
    ];

    public function passenger()
    {
        return $this->hasMany('App\Passenger','stock_id');
    }
}
