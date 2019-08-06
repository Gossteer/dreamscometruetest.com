<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public function contract()
    {
        return $this->hasMany('App\Contract', 'partners_id');
    }

    public function type_activity()
    {
        return $this->belongsTo('App\Type_Activity', 'type_activities_id');
    }
}
