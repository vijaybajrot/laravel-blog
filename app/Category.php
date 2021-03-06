<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name","slug","status"];

    public function posts()
    {
    	return $this->belongsToMany(Post::class,"post_category","category_id","post_id");
    }
}
