@extends('layouts.panel')
@section('panel-content')
    {!! Form::open(['route'=>'admin-panel.category.store','method'=>'POST']) !!}
        <legend>Add Category</legend>
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
            {!! Form::label('name', 'Category Name') !!}
            {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Category Name']) !!}
        </div> 
        <div class="form-group">
            {!! Form::label('status', 'Category Status') !!} : 
            {!! Form::radio('status', old('status',true),true) !!} Active
            {!! Form::radio('status', old('status',false)) !!} Deactive
        </div> 

        {!! Form::submit('Save',['class'=>"btn btn-primary"]) !!}
    {!! Form::close() !!}
@endsection()
