<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PRF extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'p_r_f_s_id');
    }
}
