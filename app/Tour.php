<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tour extends Model
{

    protected $fillable = [
        'Name_Tours',
        'Description',
        'type_tours_id',
        'Price',
        'Privilegens_Price',
        'Expenses',
        'Amount_Place',
        'Start_Date_Tours',
    ];

    public function employee()
    {
        return $this->belongsToMany('App\Employee');
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

}
