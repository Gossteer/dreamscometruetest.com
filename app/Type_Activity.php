<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Activity extends Model
{
    protected $table = 'type_activities';

    protected $fillable = [
        'Name_Type_Activity',
        'LogicalDelete',
    ];

    public function partner()
    {
        return $this->hasMany('App\Partner', 'type_activities_id');
    }
}
