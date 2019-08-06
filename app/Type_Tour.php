<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Tour extends Model
{
    public function tour()
    {
        return $this->hasMany('App\Tour', 'type_tours_id');
    }
}
