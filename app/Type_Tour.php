<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Tour extends Model
{
    protected $table = 'type_tours';

    protected $fillable = [
        'Name_Type_Tours', 'id', 'LogicalDelete',
    ];

    public function type_tour_many()
    {
        return $this->hasMany('App\Type_Tour_Many', 'type_tours_id');
    }
}
