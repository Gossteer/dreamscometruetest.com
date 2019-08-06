<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class New_Category extends Model
{
    public function news()
    {
        return $this->belongsToMany('App\News','new_category_news','new_category_id', 'news_id');
    }
}
