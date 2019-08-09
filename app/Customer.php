<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $guarded = [
        'White_Days', 'Black_Days', 'users_id', 'Age_Group', 'Condition', 'Debt', 'LogicalDelete'
    ];

    public function source()
    {
        return $this->belongsTo('App\Source', 'sources_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'users_id');
    }

    public function passenger()
    {
        return $this->hasMany('App\Passenger','customers_id');
    }

}
