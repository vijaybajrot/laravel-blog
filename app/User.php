<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isSuperAdmin()
    {
        return $this->user_group=="1" ? true : false;
    }

    public function hasRole($role)
    {
        if(is_string($role)){
            return !empty($this->roles()->whereName($role)->get()->toArray()) ? true : false;
        }

        foreach ($role as $user_role) {
            if($this->hasRole($user_role->name)){
                return true;
            }
        }
        return false;
    }
}
