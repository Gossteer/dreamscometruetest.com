<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function album()
    {
        return $this->belongsTo('App\Album', 'albums_id' );
    }

    public function new_category()
    {
        return $this->belongsToMany('App\New_categories','new_category_news','news_id', 'new_category_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Posts', 'news_id' );
    }
}
