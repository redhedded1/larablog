@extends('layouts.app')

@section('content')
    @component('partials.header')
        @slot('imageFileName')
            blog-header.jpg
        @endslot
        @slot('heading')
            Larablog
        @endslot
        @slot('subheading')
            A Blog built on Laravel Framework v5.4
        @endslot
    @endcomponent
    <div class="container">
    @include('vendor.flash.message')
    @if(Request::url() === route('articlesTagged', basename(Request::url())))
        <h1>Articles Tagged: {{ basename(Request::url()) }}</h1>
    @endif
        <hr />
    @foreach ($articles as $article)
            <article>
            <h2>
                <a href="{{ action('ArticlesController@show', [$article->id]) }}">{{ $article->title }}</a>
            </h2>
                <div class="body">
                    <p>{{ $article->excerpt }}</p>
                </div>
                @if ( Request::url() === route('unpublished'))
		            <?php $publish = Carbon\Carbon::now()->addDays(Carbon\Carbon::now()->diffInDays($article->published_at))->diffForHumans(); ?>
                @else
		            <?php $diff = Carbon\Carbon::today()->diffInDays($article->published_at);  ?>
                    @if ( $diff === 0)
			            <?php $publish = 'Today' ?>
                    @else
			            <?php $publish = $article->published_at->diffForHumans(); ?>
                    @endif
                @endif
                <p class="small">by {{ $article->user->name . ' ' . $publish }} </p>
        </article>
    @endforeach
    </div>
    <div class="text-center">
        {{ $articles->links() }}
    </div>
@stop