@extends('layouts.panel')

@section('panel-content')
@push('panel-actions')
  <div class="pull-left">
    <a href="{{ route('admin-panel.role.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Role</a>  
  </div>
@endpush
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Role Lable</th>
      <th>Role Name</th>
      <th>Role Description</th>
      <th>Role Permissions</th>
      <th>Action</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  	@forelse($roles as $role)
  		<tr>
        <td >{{ $role->lable }}</td>
	      <td ><code class="text-primary bg-primary">{{ $role->name }}</code></td>
        <td>{{ $role->descp }}</td>
	      <td><ul>
         @forelse($role->permissions as $role_permission)
            <li>{{$role_permission->lable}}</li>
         @empty
            Not Given Yet
         @endforelse 
        </ul></td>
	      <td width="12.5%">
		     <div class="btn-group">
			  <a href="#" class="btn btn-primary">Action</a>
			  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
			  <ul class="dropdown-menu">
			    <li><a href="{{ route('admin-panel.role.edit',$role) }}"><i class="fa fa-pencil"></i>&nbsp;Edit</a></li>
			 
			    <li><a href="{{ route('admin-panel.role.show',$role) }}" ><i class="fa fa-eye"></i>&nbsp;View</a></li>
			  </ul>
			</div>
		</td>
		<td width="5%">
		{!! Form::open(['route'=>["admin-panel.role.destroy",$role],"method"=>"DELETE"]) !!}
			<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp; Delete</button>
		{!! Form::close() !!}
		</td>
	    </tr>
  	@empty
  		<tr><td colspan="5">No categories found</td></tr>
  	@endforelse
  </tbody>
</table> 
{{ $roles->links() }}
@endsection
