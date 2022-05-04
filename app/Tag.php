<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable=['name','slug','created_at','updated_at'];

//  relation with Post model
    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
