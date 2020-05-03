<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transort extends Model
{
    protected $fillable = [
        'buses_id',
        'tour_id',
    ];

    public function bus()
    {
        return $this->belongsTo('App\Bus', 'buses_id');
    }

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tour_id');
    }
}
