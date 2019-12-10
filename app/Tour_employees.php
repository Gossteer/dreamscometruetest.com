<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour_employees extends Model
{
    //protected $table = 'tour_employees';

    protected $fillable = [
      'tour_id', 'employee_id','Occupied_Place_Bus','Salary','Confidentiality'
    ];

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tour_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}
