<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{

    protected $fillable = [
        'type_activities',
        'Name_Partners',
        'Phone_Number',
        'Address',
        'Email',
        'Site',
        'Conract_Partners',
        'INN',
    ];

    public function contract()
    {
        return $this->hasMany('App\Contract', 'partners_id');
    }

    public function type_activity()
    {
        return $this->belongsTo('App\Type_Activity', 'type_activities_id');
    }
}
