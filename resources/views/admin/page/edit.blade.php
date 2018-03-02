@extends('layouts.panel')

@section('panel-content')
    {!! Form::model($page,['route'=>['admin-panel.page.update',$page],'method'=>'PUT']) !!}
        <legend>Edit page</legend>
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
                {!! Form::textarea('content',old('content'),['class'=>'form-control','placeholder'=>'Page Content','rows'=>15]) !!}
            </div> 

              <div class="form-group">
                    {!! Form::label('publish', 'Publish Page ') !!} : 
                    {!! Form::radio('publish','1', $page->publish==true ? true : false ) !!} Yes
                    {!! Form::radio('publish') !!} No
                </div> 

        {!! Form::submit('Update',['class'=>"btn btn-primary"]) !!}
    {!! Form::close() !!}
      
@endsection
