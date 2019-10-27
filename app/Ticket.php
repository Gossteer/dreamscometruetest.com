<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function used_ticket()
    {
        return $this->hasMany('App\Used_ticket','tickets_id');
    }
}
