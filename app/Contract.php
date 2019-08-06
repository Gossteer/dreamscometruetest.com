<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contranct extends Model
{
    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tours_id');
    }

    public function type_contract()
    {
        return $this->belongsTo('App\Type_Contract', 'type_contracts_id');
    }

    public function partner()
    {
        return $this->belongsTo('App\Partner', 'partners_id');
    }
}
