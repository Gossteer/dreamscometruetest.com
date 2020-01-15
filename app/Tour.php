<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{

    protected $fillable = [
        'Name_Tours',
        'Description',
        'type_tours_id',
        'Price',
        'Duration',
        'Privilegens_Price',
        'Expenses',
        'Amount_Place',
        'Start_Date_Tours',
        'Seating',
        'Assessment',
        'Children_price',
        'Popular',
        'End_Date_Tours',
        'Confidentiality',

    ];


    public function dept()
    {
        return $this->hasMany('App\Dept', 'tours_id');
    }

    public function tour_employees()
    {
        return $this->hasMany('App\Tour_employees', 'tour_id');
    }

    public function price_per_level()
    {
        return $this->hasMany('App\Price_Per_Level', 'tour_id');
    }

    public function type_tour()
    {
        return $this->belongsTo('App\Type_Tour', 'type_tours_id');
    }

    public function route()
    {
        return $this->belongsTo('App\Route', 'routes_id');
    }

    public function bus()
    {
        return $this->belongsTo('App\Bus', 'buses_id');
    }

    public function passenger()
    {
        return $this->hasMany('App\Passenger', 'tours_id');
    }

    public function contract()
    {
        return $this->hasMany('App\Contract', 'tours_id');
    }

    public function additional_service()
    {
        return $this->hasMany('App\Additional_service', 'tours_id');
    }

}
