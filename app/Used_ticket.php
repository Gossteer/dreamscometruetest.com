<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Used_ticket extends Model
{
    public function passenger()
    {
        return $this->belongsTo('App\Passenger','passengers_id');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Ticket','tickets_id');
    }
}
