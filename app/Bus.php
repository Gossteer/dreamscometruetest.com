<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'Brand_Bus', 'State_Registration_Number',  'Year_Issue',
        'Diagnostic_card', 'Validity_Date', 'Amount_Place_Bus', 'Tachograph', 'Glonas_GPS',
    ];

    public function tour()
    {
        return $this->hasMany('App\Tour', 'buses_id');
    }
}
