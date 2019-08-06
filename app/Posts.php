<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    public function news()
    {
        return $this->belongsTo('App\News', 'news_id' );
    }

    public function source()
    {
        return $this->belongsTo('App\Source', 'sources_id' );
    }
}
