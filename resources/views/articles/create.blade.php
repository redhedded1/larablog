@extends('layouts.app')

@section('content')
    @component('partials.header')
    @slot('imageFileName')
    create.png
    @endslot
    @slot('heading')
    Larablog
    @endslot
    @slot('subheading')
    Create New Article
    @endslot
    @endcomponent

<div class="container">

{!! Form::model($article = new \App\Article, ['action' => 'ArticlesController@store', 'files' => true, 'id' => 'createArticle']) !!}
@include('partials._form', ['submitButton' => 'Add Article'])
{!! Form::close() !!}
@include('errors._form')
@stop
</div>