<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Activity extends Model
{
    public function partner()
    {
        return $this->hasMany('App\Partner', 'type_activities_id');
    }
}
