<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function source()
    {
        return $this->belongsTo('App\Source', 'sources_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'users_id');
    }

    public function passenger()
    {
        return $this->hasMany('App\Passenger','customers_id');
    }

}
