<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drivers_Lisense extends Model
{
    public function driving_lisense_category()
    {
        return $this->belongsTo('App\Driver_License_Category', 'driving_license_categories_id');
    }

    public function employee()
    {
        return $this->hasMany('App\Employee', 'Drivers_lisense_id');
    }
}
