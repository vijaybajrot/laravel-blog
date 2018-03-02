@extends('layouts.panel')
@section('panel-content')
    {!! Form::open(['route'=>'admin-panel.post.store','method'=>'POST']) !!}
        <legend>Add Post</legend>
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
            {!! Form::label('title', 'Post Title') !!}
            {!! Form::text('title',old('title'),['class'=>'form-control','placeholder'=>'Post Title']) !!}
        </div> 

            <div class="form-group">
                {!! Form::label('content', 'Post Content') !!}
                <div id="toolbar"></div>
                {!! Form::textarea('content',old('content'),['class'=>'form-control','placeholder'=>'Post Content','rows'=>15]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('excerpt', 'Post Excerpt') !!}
                {!! Form::textarea('excerpt',old('excerpt'),['class'=>'form-control','placeholder'=>'Post Excerpt','rows'=>5]) !!}
            </div>

                <div class="form-group">
                     {!! Form::label('categories', 'Categories') !!}
                     {!! Form::select('categories[]', $categories,null,["class"=>"form-control multi-select",'placeholder' => 'Pick a category','multiple'=>"true"]) !!}     
                 </div>  

                <div class="form-group">
                    {!! Form::label('publish', 'Publish Post ') !!} : 
                    {!! Form::radio('publish', old('publish',true),true) !!} Yes
                    {!! Form::radio('publish', old('publish',false)) !!} No
                </div> 

        {!! Form::submit('Save',['class'=>"btn btn-primary"]) !!}
    {!! Form::close() !!}
@endsection()
