<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function price_per_level()
    {
        return $this->hasMany('App\Price_Per_Level', 'level_id');
    }

    public function employee()
    {
        return $this->hasMany('App\Employee', 'level_id');
    }
}
