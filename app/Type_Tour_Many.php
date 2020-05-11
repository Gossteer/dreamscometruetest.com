<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Tour_Many extends Model
{
    protected $table = 'type_tour_manies';
    protected $fillable = ['type_tours_id','tour_id'];

    public function type_tour()
    {
        return $this->belongsTo('App\Type_Tour', 'type_tours_id');
    }

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tour_id');
    }
}
