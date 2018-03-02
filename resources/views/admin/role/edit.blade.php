@extends('layouts.panel')
@section('panel-content')
    {!! Form::model($role,['route'=>['admin-panel.role.update',$role],'method'=>'PUT']) !!}
        <legend>Edit Role</legend>
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
            {!! Form::label('name', 'Role Name') !!}
            {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Role Name']) !!}
        </div>
            <div class="form-group">
                 {!! Form::label('descp', 'Role Description') !!}
                 {!! Form::textarea('descp',null,['class'=>'form-control','placeholder'=>'Information About the Role','rows'=>4]) !!}
             </div>  

              <div class="form-group">
                 {!! Form::label('permissions', 'Role Permisions') !!}
                 {!! Form::select('permissions[]',$permissions,$role->permissions()->getRelatedIds()->toArray(),['class'=>'form-control multi-select','multiple'=>true]) !!}
             </div>  




        {!! Form::submit('Update',['class'=>"btn btn-primary"]) !!}
    {!! Form::close() !!}
@endsection()
