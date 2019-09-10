<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    protected $fillable = [
        'tours_id', 'partners_id', 'Document_Contract'
    ];

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
