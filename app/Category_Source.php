<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_Source extends Model
{
    protected $fillable = [
        'Name_Category_Source',
    ];

    public function source()
    {
        return $this->hasMany('App\Source', 'Category_Sources_id' );
    }
}
