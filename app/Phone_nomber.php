<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone_nomber extends Model
{
    protected $fillable = ['Representative','Phone_Number'];

    public function partner()
    {
        return $this->belongsTo('App\Partner', 'partners_id');
    }
}
