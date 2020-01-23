<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{

    protected $guarded = [];

    public function tour()
    {
        return $this->hasMany('App\Tour', 'routes_id');
    }
}
