<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_Source extends Model
{
    public function source()
    {
        return $this->hasMany('App\Source', 'Category_Sources_id' );
    }
}
