<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour_employees extends Model
{
    //protected $table = 'tour_employees';

    protected $fillable = [
      'tour_id', 'employee_id','Occupied_Place_Bus','Salary','Confidentiality', 'partner_id'
    ];

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tour_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }

    public function partner()
    {
      return $this->belongsTo('App\Partner', 'partner_id');
    }
}
