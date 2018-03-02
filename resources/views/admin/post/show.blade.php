@extends('layouts.app')

@section('content')
<div class="container-fuild page">
    <div class="row page-title">
        <div class="col-md-10 col-md-offset-1">
           <h2 class="title-text">{{ $post->title }}</h2>
        </div>
    </div>
    <div class="row content">
        <div class="col-md-10 col-md-offset-1">
           <div class="peragraph">{{ $post->content }}</div>
        </div>
    </div>
</div>
@endsection
