<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Contract extends Model
{
    protected $table = 'type_contracts';

    public function contract()
    {
        return $this->hasMany('App\Contract', 'type_contracts_id');
    }
}
