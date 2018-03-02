<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
class RoleController extends Controller
{
    protected $limit = 20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->paginate($this->limit);
        return view('admin.role.list',compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = \App\Permission::pluck("lable","id");
        return view("admin.role.add",compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "lable" => "required"
        ]);
        $role = new Role($request->all());
        $role->name = str_slug($request->lable);
        if(!is_null($role->whereName(str_slug($request->lable))->first())){
            flashMessage("Role Name Allready Used , try another", "error");
            return back();
        }

        $role->save();

        $role->permissions()->attach($request->permissions);
        flashMessage("New Role Created Successfully", "success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role->load("permissions");
        $permissions = \App\Permission::pluck("lable","id");
        return view("admin.role.edit",compact('permissions','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request,[
            "lable" => "required"
        ]);
        $role->fill($request->all());
        $role->save();
        if(empty($request->permissions)){
             $role->permissions()->detach();
        }
        $role->permissions()->sync($request->permissions);
        flashMessage("New Role Created Successfully", "success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();
        flashMessage("Role deleted from database", "success");
        return back();
    }

    public function assignRoles()
    {
        $users = \App\User::with("roles")->paginate(20);
        $roles = Role::pluck("lable","id");
        return view("admin.role.assign_roles",compact("users","roles"));
    }

    public function assign(Request $request)
    {
        $user = \App\User::find($request->user_id);

        if(is_null($user)){
            flashMessage("User not exist in database", "error");
            return back();
        }
        if(empty($request->roles)){
            $user->roles()->detach();
            flashMessage("All Role removed for this user", "success");
            return back();
        }

        $user->roles()->sync($request->roles);
        flashMessage("Role Assigned ", "success");
        return back();
    }
}
