<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function photo()
    {
        return $this->hasMany('App\Photo', 'albums_id' );
    }

    public function news()
    {
        return $this->hasMany('App\News', 'albums_id' );
    }
}
