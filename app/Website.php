<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = ['Site', 'partners_id'];

    public function partner()
    {
        return $this->belongsTo('App\Partner', 'partners_id');
    }
}
