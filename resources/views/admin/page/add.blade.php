@extends('layouts.panel')
@section('panel-content')
    {!! Form::open(['route'=>'admin-panel.page.store','method'=>'POST']) !!}
        <legend>Add page</legend>
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
            {!! Form::text('title',old('title'),['class'=>'form-control','placeholder'=>'Page Title']) !!}
        </div> 

            <div class="form-group">
                {!! Form::label('content', 'Page Content') !!}
                <div id="toolbar"></div>
                {!! Form::textarea('content',old('content'),['class'=>'form-control','placeholder'=>'Page Content','rows'=>15]) !!}
            </div> 

                <div class="form-group">
                    {!! Form::label('publish', 'Publish Page ') !!} : 
                    {!! Form::radio('publish', old('publish',true),true) !!} Yes
                    {!! Form::radio('publish', old('publish',false)) !!} No
                </div> 

        {!! Form::submit('Save',['class'=>"btn btn-primary"]) !!}
    {!! Form::close() !!}
@endsection()
