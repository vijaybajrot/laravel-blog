<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        
        $this->registerPolicies($gate);

        $roles = \App\Role::with("permissions")->get();
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                  $role_name = strtolower($role->name);
                  $permission_name = $permission->name;
                  $gate->define($role_name.'.'.$permission->name, function ($user) use($role,$permission){
                        if($user->isSuperAdmin()){
                           // return true;
                        }
                        if($user->hasRole($role->name)){
                            if($role->hasPermissions($permission->name)){
                                return true;    
                            }
                            return false;
                        }else{
                            return false;
                        }
                  });       
            }
        }
        
        
        //
    }
}
