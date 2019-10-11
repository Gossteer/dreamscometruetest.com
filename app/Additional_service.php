<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional_service extends Model
{
    protected $guarded = [];

    public function tours()
    {
        return $this->belongsTo('App\Tour', 'tours_id');
    }

    public function purchased_additional_services()
    {
        return $this->hasMany('App\Purchased_additional_services','additional_service_id');
    }
}
