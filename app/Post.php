<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    

    // relation with user model
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // relation with category model
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    // relation with Tag model
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function favorite_to_user()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
