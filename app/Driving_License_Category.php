<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driving_License_Category extends Model
{
    public function drivers_lisense()
    {
        return $this->hasMany('App\Drivers_Lisense', 'driving_license_categories_id');
    }


}
