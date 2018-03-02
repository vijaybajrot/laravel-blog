<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ["id"];
	protected $dates = ["published_at"];
    //

    public function categories()
    {
        return $this->belongsToMany(Category::class,"post_category","post_id","category_id");
    }
    
    public function getCreatedOnAttribute()
    {
 		return $this->parseDateTime($this->created_at);   	
    }

    public function getUpdatedOnAttribute()
    {
    	return $this->parseDateTime($this->updated_at);
    }
    public function getPublishedOnAttribute()
    {
        return !is_null($this->published_at) ? $this->parseDateTime($this->published_at) : null;
    }
    public function parseDateTime($date)
    {
    	return \Carbon\Carbon::parse($date)->format("d-M-y h:i A");
    }

    public function scopeSearch($query,$keyword)
    {
        $query->where("title","like","%{$keyword}%")
              ->orWhere("slug","like","%{$keyword}%");
    }
}