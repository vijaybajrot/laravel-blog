@extends('layouts.panel')

@section('panel-content')
@push('panel-actions')
  <div class="pull-left">
    <a href="{{ route('admin-panel.page.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Page</a>  
  </div>
@endpush
@push('panel-actions')
  <div class="pull-left m-l-10">
  <form action="{{ route('admin-panel.page.search') }}" method="GET" class="form-inline" role="form">
  
    <div class="form-group">
      <label class="sr-only" for="">Search</label>
      <input type="text" class="form-control" name="q" placeholder="Search by page title or slug" style="width: 300px;" required>
    </div>
  
    
  
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
  </div>
@endpush
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Page Title</th>
      <th>Page Slug</th>
      <th>Publish Status</th>
     <th>Action</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  	@forelse($pages as $page)
  		<tr>
	      <td ><h5>{{ str_limit($page->title,50) }}</h5><br>
            <p>
              <b>Created On : </b> {{ $page->created_on }}<br>
              <b>Updated On : </b> {{ $page->updated_on }}
            </p>
        </td>
	      <td><h6>{{ str_limit($page->slug,100) }}</h6></td>
	      <td>{!! $page->publish==true ? '<span class="label label-success">Published</span><br><p><b>Published On : </b> '.$page->updated_on.'</p>' : '<span class="label label-warning">Unpublished</span>' !!}</td>
	      <td width="12.5%">
		     <div class="btn-group">
			  <a href="#" class="btn btn-primary">Action</a>
			  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
			  <ul class="dropdown-menu">
			    <li><a href="{{ route('admin-panel.page.edit',$page->id) }}"><i class="fa fa-pencil"></i>&nbsp;Edit</a></li>
			    <li><a href="{{ route('admin-panel.page.updateStatus', $page->publish==true ? ['id' => $page->id, 'action'=>'unpublish'] : ['id' => $page->id, 'action'=>'publish']) }}" class="text-danger"><i class="fa fa-globe"></i>&nbsp;
          @if($page->publish==true) Unpublish @else Publish @endif
          </a></li>
			    <li><a href="{{ url('/',[$page->slug.'.html']) }}" @if($page->publish==false) class="disableClick" @endif ><i class="fa fa-eye"></i>&nbsp;Preview</a></li>
			  </ul>
			</div>
		</td>
		<td width="5%">
		{!! Form::open(['route'=>["admin-panel.page.destroy",$page->id],"method"=>"DELETE"]) !!}
			<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp; Delete</button>
		{!! Form::close() !!}
		</td>
	    </tr>
  	@empty
  		<tr><td colspan="5">No pages found</td></tr>
  	@endforelse
  </tbody>
</table> 
{{ $pages->links() }}
@endsection
