<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name','slug','image'];

//  relation with Post model
    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}


