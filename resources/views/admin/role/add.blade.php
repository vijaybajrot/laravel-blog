@extends('layouts.panel')
@section('panel-content')
    {!! Form::open(['route'=>'admin-panel.role.store','method'=>'POST']) !!}
        <legend>Add Role</legend>
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
            {!! Form::label('lable', 'Role Name') !!}
            {!! Form::text('lable',old('lable'),['class'=>'form-control','placeholder'=>'Role Name']) !!}
        </div>
            <div class="form-group">
                 {!! Form::label('descp', 'Role Description') !!}
                 {!! Form::textarea('descp',null,['class'=>'form-control','placeholder'=>'Information About the Role','rows'=>4]) !!}
             </div>  
              <div class="form-group">
                 {!! Form::label('permissions', 'Role Permisions') !!}
                 {!! Form::select('permissions[]',$permissions,null,['class'=>'form-control multi-select','multiple'=>true]) !!}
             </div>  




        {!! Form::submit('Save',['class'=>"btn btn-primary"]) !!}
    {!! Form::close() !!}
@endsection()
