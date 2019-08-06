<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driving_License_Category extends Model
{
    public function employee()
    {
        return $this->hasMany('App\Employee', 'driving_license_categories_id');
    }
}
