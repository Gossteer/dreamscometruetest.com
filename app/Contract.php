<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    protected $fillable = [
        'Name_Contract_doc', 'tours_id', 'partners_id', 'Document_Contract', 'Salary'
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
