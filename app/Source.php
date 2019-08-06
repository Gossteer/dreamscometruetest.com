<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public function posts()
    {
        return $this->hasMany('App\Posts', 'sources_id' );
    }

    public function customer()
    {
        return $this->hasOne('App\Customer', 'sources_id');
    }
}
