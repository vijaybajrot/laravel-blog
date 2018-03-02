<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = ["name","lable","descp"];
	public $timestamps = false;
    //
    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class);
    }

    public function hasPermissions($permission)
    {
        if(is_string($permission)){
            return !empty($this->permissions()->whereName($permission)->get()->toArray()) ? true : false;
        }
        foreach ($permission as $role_permission) {
            if($this->hasPermissions($role_permission->name)){
                return true;
            }
        }
        return false;
    }
}
