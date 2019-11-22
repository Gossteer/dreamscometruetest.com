<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['Representative_Email', 'Email', 'partners_id'];

    public function partner()
    {
        return $this->belongsTo('App\Partner', 'partners_id');
    }
}
