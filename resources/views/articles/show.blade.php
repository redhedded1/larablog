@extends('layouts.app')

@section('content')

        <header class="intro-header" style="background-image: url({{ $imageUrl }})">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <div class="site-heading">
                            <h1>{{ $article->title }}</h1>
                            <hr class="small">
                            <span class="subheading">by {{ $article->user->name }} on {{ $article->published_at->toFormattedDateString() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    <div class="container">
    <article>
        {!! $article->body !!}
    </article>
        @unless ($article->tags->isEmpty())
            <h5>Tags:</h5>
        <ul class="tags">
            @foreach ($article->tags as $tag)
                <li style="float:left;">{!! link_to_action('TagsController@showTaggedArticles', $tag->name, $tag->name) !!}</li>
            @endforeach
        </ul>
        @endunless
        <div style="clear:both;min-height:25px;"></div>
        <div class="panel">
        <a href="{{ url('/articles') }}"><i class="fa fa-arrow-circle-left"></i> Back to Articles</a>
        </div>
        @if(Auth::user() && Auth::id() === $article->user_id)
        <div>
            <a class="btn btn-default" href="{{ url(route('articles.edit', ['article' => $article] )) }}">Edit Article</a>

            {{ Form::open(['method' => 'DELETE', 'route' => ['articles.destroy', $article->id], 'class' => 'pull-right']) }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'name' => 'delete_article']) }}
            {{ Form::close() }}
        </div>
        @endif
        @include('partials.deleteModal')
    </div>

@stop