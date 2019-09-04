<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Tour extends Model
{
    protected $table = 'type_tours';

    protected $fillable = [
'Name_Type_Tours', 'id',
    ];

    public function tour()
    {
        return $this->hasMany('App\Tour', 'type_tours_id');
    }
}
