@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method'=>'POST' ]) !!}
        <div class="form-groub">
            {{Form::label('title','Title')}}
            {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title'])}}
        </div>
        <br>
        <div class="form-groub">
            {{Form::label('body','Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text'])}}
        </div>
        <br>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
