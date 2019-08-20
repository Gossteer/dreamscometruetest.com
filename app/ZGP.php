<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZGP extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'z_g_p_s_id');
    }
}
