@extends('layouts.panel')

@section('panel-content')
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>FullName</th>
      <th>Email</th>
      <th>Username</th>
      <th>Assign Roles</th>
    </tr>
  </thead>
  <tbody>
  	@forelse($users as $user)
  		<tr>
	      <td >{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->username }}</td>
		<td >
		{!! Form::open(["route"=>"admin.assign","method"=>"POST"]) !!}
      {!! Form::hidden("user_id",$user->id) !!}
      {!! Form::select('roles[]',$roles,$user->roles()->getRelatedIds()->toArray(),['class'=>'form-control multi-select','multiple'=>true]) !!}
   		<button type="submit" class="btn {{ count($user->roles()->getRelatedIds()->toArray()) > 0 ? "btn-success" : "btn-danger" }} m-l-10"><i class="fa fa-toggle-on"></i>&nbsp; Assign / Remove Role</button>
		{!! Form::close() !!}
		</td>
	    </tr>
  	@empty
  		<tr><td colspan="5">No categories found</td></tr>
  	@endforelse
  </tbody>
</table> 
{{ $users->links() }}
@endsection
