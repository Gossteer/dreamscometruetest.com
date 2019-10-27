<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passport_Date extends Model
{
    public function employee()
    {
        return $this->hasMany('App\Employee', 'Passport_date_id');
    }
}
