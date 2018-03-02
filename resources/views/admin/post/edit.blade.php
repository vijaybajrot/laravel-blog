@extends('layouts.panel')

@section('panel-content')
    {!! Form::model($post,['route'=>['admin-panel.post.update',$post],'method'=>'PUT']) !!}
        <legend>Edit Post</legend>
        @if (count($errors) > 0)
            <div class='alert alert-danger'>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title',old('title'),['class'=>'form-control','placeholder'=>'Post Title']) !!}
        </div> 

            <div class="form-group">
                {!! Form::label('content', 'Post Content') !!}
                {!! Form::textarea('content',old('content'),['class'=>'form-control','placeholder'=>'Post Content','rows'=>15]) !!}
            </div> 

            <div class="form-group">
                {!! Form::label('excerpt', 'Post Excerpt') !!}
                {!! Form::textarea('excerpt',old('excerpt'),['class'=>'form-control','placeholder'=>'Post Content','rows'=>5]) !!}
            </div> 
            <div class="form-group">
                
                 {!! Form::label('categories', 'Categories') !!}
                 {!! Form::select('categories[]', $categories,$post->categories()->getRelatedIds()->toArray(),["class"=>"form-control multi-select",'placeholder' => 'Pick a category','multiple'=>"true"]) !!}     
             </div>

              <div class="form-group">
                    {!! Form::label('publish', 'Publish Post ') !!} : 
                    {!! Form::radio('publish','1', $post->publish==true ? true : false ) !!} Yes
                    {!! Form::radio('publish') !!} No
                </div> 

        {!! Form::submit('Update',['class'=>"btn btn-primary"]) !!}
    {!! Form::close() !!}
      
@endsection
