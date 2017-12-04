<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;

class TagsController extends Controller
{
	/**
	 * TagsController constructor.
	 */
	public function __construct(){
		$this->middleware('auth', ['except' => ['showTaggedArticles']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$tags = Tag::orderBy('name')->paginate(5);

		return view( 'tags.edit', compact( 'tags' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Tag $tag)
	{
		//
	}

	public function showTaggedArticles($name)
	{
		$tag = \App\Tag::where('name', $name)->firstOrFail();
		$articles =  $tag->articles()->published()->paginate(5);

		return view( 'articles.index', compact( 'articles' ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(TagRequest $request, Tag $tag)
	{
		$tag->update( $request->all() );

		$tags = Tag::orderBy('name')->paginate(5);

		$message = 'The tag has been changed to ' . $tag->name . '.';
		flash( $message, 'success' );

		return redirect( route('tags.index') );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$tag = Tag::findOrFail( $id );

		$affectedRows = Tag::destroy( $id );

		$message = 'The tag ' . $tag->name . 'has been removed.';
		flash( $message, 'danger' );

		return redirect( route('tags.index') );


	}
}
