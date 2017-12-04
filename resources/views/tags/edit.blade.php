@extends('layouts.app')

@section('content')
    <header class="intro-header" style="background-image: url('/img/tags.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Larablog</h1>
                        <hr class="small">
                        <span class="subheading">Edit Tags</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">

        @include('vendor.flash.message')

        @foreach($tags as $tag)
            <div class="col-md-8">
                @include('errors._form')
                {!! Form::model($tag, ['method' => 'PATCH', 'action' => ['TagsController@update', $tag], 'class' => 'form-inline']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary form-control pull-right']) !!}
                {!! Form::close() !!}
            </div>
            <div class="col-md-4">
                {{ Form::open(['method' => 'DELETE', 'route' => ['tags.destroy', $tag->id], 'class' => 'form-inline pull-right']) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'name' => 'delete_tag']) }}
                {{ Form::close() }}
            </div>
            <br><hr><br>
        @endforeach

    </div>
    <div class="text-center">
        {{ $tags->links() }}
    </div>
@stop