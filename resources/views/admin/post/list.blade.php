@extends('layouts.panel')

@section('panel-content')
@push('panel-actions')
  <div class="pull-left">
    <a href="{{ route('admin-panel.post.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Post</a>  
  </div>
@endpush
@push('panel-actions')
  <div class="pull-left m-l-10">
  <form action="{{ route('admin-panel.post.search') }}" method="GET" class="form-inline" role="form">
  
    <div class="form-group">
      <label class="sr-only" for="">Search</label>
      <input type="text" class="form-control" name="q" placeholder="Search by post title or slug" style="width: 300px;" required>
    </div>
  
    
  
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
  </div>
@endpush
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Post Title</th>
      <th>Post Slug</th>
      <th>Post Categories</th>
      <th>Publish Status</th>
     <th>Action</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  	@forelse($posts as $post)
  		<tr>
	      <td width="25%"><h5><a class="text-primary" href="#">{{ str_limit($post->title,50) }}</a></h5><br>
            <p>
              <b>Created On : </b> {{ $post->created_on }}<br>
              <b>Updated On : </b> {{ $post->updated_on }}
            </p>
        </td>
        <td width="15%"><h6><code class="text-success bg-success">{{ str_limit($post->slug,100) }}</code></h6></td>
	      <td width="20%">
         <ul>
         @forelse($post->categories as $category)
            <li>{{ ucfirst($category->name) }}</li>
         @empty
          -
         @endforelse
         </ul> 
        </td>
	      <td>{!! $post->publish==true ? '<span class="label label-success">Published</span><br><p><b>Published On : </b> '.$post->published_on.'</p>' : '<span class="label label-warning">Unpublished</span>' !!}</td>
	      <td width="12.5%">
		     <div class="btn-group">
			  <a href="#" class="btn btn-primary">Action</a>
			  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
			  <ul class="dropdown-menu">
			    <li><a href="{{ route('admin-panel.post.edit',$post->id) }}"><i class="fa fa-pencil"></i>&nbsp;Edit</a></li>
			    <li><a href="{{ route('admin-panel.post.updateStatus', $post->publish==true ? ['id' => $post->id, 'action'=>'unpublish'] : ['id' => $post->id, 'action'=>'publish']) }}" class="text-danger"><i class="fa fa-globe"></i>&nbsp;
          @if($post->publish==true) Unpublish @else Publish @endif
          </a></li>
			    <li><a href="{{ route('admin-panel.post.show',$post) }}" ><i class="fa fa-eye"></i>&nbsp;Preview</a></li>
			  </ul>
			</div>
		</td>
		<td width="5%">
		{!! Form::open(['route'=>["admin-panel.post.destroy",$post->id],"method"=>"DELETE"]) !!}
			<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp; Delete</button>
		{!! Form::close() !!}
		</td>
	    </tr>
  	@empty
  		<tr><td colspan="5">No posts found</td></tr>
  	@endforelse
  </tbody>
</table> 
{{ $posts->links() }}
@endsection
