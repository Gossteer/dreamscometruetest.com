<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = ['Name', 'Surname', 'Middle_Name', 'Byrthday', 'Phone_Number', 'jobs_id', 'users_id',];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->hasOne('App\User', 'users_id');
    }

    public function level()
    {
        return $this->belongsTo('App\Level', 'level_id');
    }

    public function work_schedule()
    {
        return $this->belongsTo('App\Work_Schedule', 'Work_Schedule_id');
    }

    public function driving_license_category()
    {
        return $this->belongsTo('App\Driving_License_Category', 'driving_license_categories_id');
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
