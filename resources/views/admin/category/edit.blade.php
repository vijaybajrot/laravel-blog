@extends('layouts.panel')

@section('panel-content')
    {!! Form::model($category,['route'=>['admin-panel.category.update',$category],'method'=>'PUT']) !!}
        <legend>Edit category</legend>
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
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'category Title']) !!}
        </div> 


              <div class="form-group">
                    {!! Form::label('status', 'Category Status ') !!} : 
                    {!! Form::radio('status','1', $category->status==true ? true : false ) !!} Active
                    {!! Form::radio('status') !!} Deactive
                </div> 

        {!! Form::submit('Update',['class'=>"btn btn-primary"]) !!}
    {!! Form::close() !!}
      
@endsection
