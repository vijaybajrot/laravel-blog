<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;



class Page extends Model
{
    protected $fillable = ['title','content','publish','published_at'];

   	/*public function getRouteKeyName()
    {
    	return 'slug';
    }	*/


   public function getCreatedOnAttribute()
   {
      Carbon::now();
   	  return $this->parseDateTime($this->created_at);
   }

   public function getUpdatedOnAttribute()
   {
       return $this->parseDateTime($this->updated_at);
   }

   public function parseDateTime($date)
   {
	   	return Carbon::parse($date)->format('d-M-y, h:i A');
   }

   public function scopeSearch($query,$searchKey)
   {
      return $query->where("title","like","%{$searchKey}%")
                  ->orWhere("slug","like","%{$searchKey}%");
   }
}
