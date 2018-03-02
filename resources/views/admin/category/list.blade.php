@extends('layouts.panel')

@section('panel-content')
@push('panel-actions')
  <div class="pull-left">
    <a href="{{ route('admin-panel.category.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Category</a>  
  </div>
@endpush
@push('panel-actions')
  <div class="pull-left m-l-10">
  <form action="{{ route('admin-panel.category.search') }}" method="GET" class="form-inline" role="form">
  
    <div class="form-group">
      <label class="sr-only" for="">Search</label>
      <input type="text" class="form-control" name="q" placeholder="Search by category title or slug" style="width: 300px;" required>
    </div>
  
    
  
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
  </div>
@endpush
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Category Name</th>
      <th>Category Slug</th>
      <th>Posts</th>
      <th>Action</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  	@forelse($categories as $category)
  		<tr>
	      <td ><h5>{{ str_limit($category->name,50) }}</h5></td>
        <td><h6>{{ str_limit($category->slug,100) }}</h6></td>
	      <td>{{ $category->posts_count }}</td>
	      <td width="12.5%">
		     <div class="btn-group">
			  <a href="#" class="btn btn-primary">Action</a>
			  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
			  <ul class="dropdown-menu">
			    <li><a href="{{ route('admin-panel.category.edit',$category) }}"><i class="fa fa-pencil"></i>&nbsp;Edit</a></li>
			 
			    <li><a href="{{ route('admin-panel.category.show',$category) }}" ><i class="fa fa-eye"></i>&nbsp;View</a></li>
			  </ul>
			</div>
		</td>
		<td width="5%">
		{!! Form::open(['route'=>["admin-panel.category.destroy",$category],"method"=>"DELETE"]) !!}
			<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp; Delete</button>
		{!! Form::close() !!}
		</td>
	    </tr>
  	@empty
  		<tr><td colspan="5">No categories found</td></tr>
  	@endforelse
  </tbody>
</table> 
{{ $categories->links() }}
@endsection
