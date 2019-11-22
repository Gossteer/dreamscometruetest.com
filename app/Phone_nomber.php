<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone_nomber extends Model
{
    protected $table = 'phone_nombers';
    protected $fillable = ['Representative','Phone_Number', 'partners_id'];

    public function partner()
    {
        return $this->belongsTo('App\Partner', 'partners_id');
    }
}
