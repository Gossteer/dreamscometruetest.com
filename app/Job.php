<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    protected $fillable = ['Job_Title','Salary','Company'];

    public function employee()
    {
        return $this->hasMany('App\Employee', 'jobs_id');
    }
}
