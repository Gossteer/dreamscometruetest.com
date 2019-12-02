<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = [
        'Name',
        'Surname',
        'Middle_Name',
        'Byrthday',
        'Phone_Number',
        'jobs_id',
        'users_id',
        'Description',
        'Contract_Employee',
        'Set_Permission',
        'Man_brought',
        'Joint_excursions',
        'Level'
        ];

    protected $hidden = [

    ];

    public function dept()
    {
        return $this->hasMany('App\Dept', 'employee_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'users_id');
    }

    public function work_schedule()
    {
        return $this->belongsTo('App\Work_Schedule', 'Work_Schedule_id');
    }

    public function drivers_license()
    {
        return $this->belongsTo('App\Drivers_Lisense', 'Drivers_lisense_id');
    }

    public function passport_date()
    {
        return $this->belongsTo('App\Passport_Date', 'Passport_date_id');
    }

    public function job()
    {
        return $this->belongsTo('App\Job', 'jobs_id');
    }

    public function tour_employees()
    {
        return $this->hasMany('App\Tour_employees', 'employee_id');
    }

    public function passenger()
    {
        return $this->hasMany('App\Passengers', 'employee_id');
    }
}
