@extends('layouts.app')

@section('content')
    <header class="intro-header" style="background-image: url('/img/create.png')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Larablog</h1>
                        <hr class="small">
                        <span class="subheading">Edit Article</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
    <h1>Edit: {!! $article->title !!}</h1>
    <hr>
    </div>
    {!! Form::model($article, ['method' => 'PATCH', 'action' => ['ArticlesController@update', $article->id], 'files' => true]) !!}
    @include('partials._form', ['submitButton' => 'Update Article'] )
    {!! Form::close() !!}
    @include('errors._form')
@stop