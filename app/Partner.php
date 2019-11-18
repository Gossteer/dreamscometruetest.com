<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{

    protected $fillable = [
        'type_activities_id',
        'partners_id',
        'Name_Partners',
        'Conract_Partners',
        'INN',
        'LogicalDelete',
    ];

    public function contract()
    {
        return $this->hasMany('App\Contract', 'partners_id');
    }

    public function address()
    {
        return $this->hasMany('App\Address', 'partners_id');
    }

    public function email()
    {
        return $this->hasMany('App\Email', 'partners_id');
    }

    public function phone_nomber()
    {
        return $this->hasMany('App\Phone_nomber', 'partners_id');
    }

    public function type_activity()
    {
        return $this->belongsTo('App\Type_Activity', 'type_activities_id');
    }
}
