<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Contract extends Model
{
    public function contract()
    {
        return $this->hasMany('App\Contract', 'type_contracts_id');
    }
}
