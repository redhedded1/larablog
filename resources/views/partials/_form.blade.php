<div class="col-md-8 col-md-offset-2">
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'body']) !!}
</div>
<div class="form-group">
    {!! Form::label('excerpt', 'Excerpt:') !!}
    {!! Form::text('excerpt', null, ['class' => 'form-control truncate', 'id' => 'excerpt', 'readonly' => 'true']) !!}
</div>
<div class="form-group">
    <label>Banner Image:</label>
    {!! Form::file('image', ['class' => 'form-control-file']) !!}
</div>
<div class="form-group">
    {!! Form::label('published_at', 'Publish on:') !!}
    {!! Form::input('date', 'published_at', $article->published_at->format('Y-m-d'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('tag_list', 'Tags') !!}
    {!! Form::select('tag_list[]', $tags, $tag_list, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
</div>
<div class="form-group col-md-3 col-md-offset-9">
    {!! Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>
</div>