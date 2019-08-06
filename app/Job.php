<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function employee()
    {
        return $this->hasMany('App\Employee', 'jobs_id');
    }
}
