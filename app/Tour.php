<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{

    protected $fillable = [
        'Name_Tours',
        'Description',
        'Price',
        'Duration',
        'Privilegens_Price',
        'Expenses',
        'Amount_Place',
        'Start_Date_Tours',
        'Seating',
        'Occupied_Place',
        'Assessment',
        'Children_price',
        'Popular',
        'End_Date_Tours',
        'Confidentiality',
        'Program',
        'Start_point',
        'Confirmation_Tours',
        'LogicalDelete',
        'Profit',
        'created_at',
        'bus_Main_Transort',
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

    public function type_tour_many()
    {
        return $this->hasMany('App\Type_Tour_Many', 'tour_id');
    }

    public function transport()
    {
        return $this->hasMany('App\Transort', 'tour_id');
    }

    public function route()
    {
        return $this->hasMany('App\Route', 'routes_id');
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
