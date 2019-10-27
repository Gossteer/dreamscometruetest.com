<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    public function childrens()
    {
        return $this->belongsTo('App\Children','childrens_id');
    }
}
