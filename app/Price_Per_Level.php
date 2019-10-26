<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price_Per_Level extends Model
{
    public function level()
    {
        return $this->belongsTo('App\Level', 'level_id');
    }

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tour_id');
    }
}
