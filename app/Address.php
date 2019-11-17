<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = ['Address', 'partners_id'];

    public function partner()
    {
        return $this->belongsTo('App\Partner', 'partners_id');
    }
}
