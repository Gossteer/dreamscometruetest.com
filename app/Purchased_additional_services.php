<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchased_additional_services extends Model
{
    protected $guarded = [];

    public function additional_service()
    {
        return $this->belongsTo('App\Additional_service', 'additional_service_id');
    }

    public function passengers()
    {
        return $this->belongsTo('App\Passenger', 'passengers_id');
    }
}
