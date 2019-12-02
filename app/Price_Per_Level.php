<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price_Per_Level extends Model
{
    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tour_id');
    }
}
