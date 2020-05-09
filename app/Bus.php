<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'Brand_Bus', 'State_Registration_Number',  'Year_Issue', 'employee_id',
        'Diagnostic_card', 'Validity_Date', 'Amount_Place_Bus', 'Tachograph', 
        'Glonas_GPS', 'Title_Transport', 'Description', 'Company', 'Classes',
        'Type_Transport', 'Main_Transort', 'LogicalDelete'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }

    public function transport()
    {
        return $this->hasMany('App\Transort', 'buses_id');
    }
}
