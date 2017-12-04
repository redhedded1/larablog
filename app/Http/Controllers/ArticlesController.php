<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ArticlesController extends Controller
{
	/**
	 * ArticlesController constructor.
	 */
	public function __construct(){
		$this->middleware('auth', ['except' => ['index', 'show']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$articles = Article::latest('published_at')->published()->paginate(5);

		return view( 'articles.index', compact('articles') );
	}

	public function indexUnPublished()
	{
		$articles = Article::latest('published_at')->scheduledToBePublished()->paginate(5);

		return view( 'articles.index', compact('articles') );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$tags = Tag::pluck( 'name', 'id' );
		$tag_list = null;
		return view( 'articles.create', compact('tags', 'tag_list') );
	}

	/**
	 * Save article
	 *
	 * @param ArticleRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(ArticleRequest $request)
	{
		dd($request);
		$article = Auth::user()->articles()->create($request->all());
		$article->addMediaFromRequest( 'image' )->toCollection( 'images' );

		// Find last id in media library
		$lastId = DB::table('media')->latest('id')->first();

		$dir = '/media/' . $lastId->id . '/';
		$files = Storage::disk('media')->files($dir);
		foreach($files as $file){
			$article->addMedia($file)->toMediaLibrary('images');
		}

		$tagList = $request->tag_list;
		if(is_array($request->tag_list)){
			$len = count($tagList);
			for ($i = 0; $i < $len; $i++) {
				if((string)(int)$tagList[$i] !== $tagList[$i]){
					$tag = Tag::create(['name' => $tagList[$i]]);
					$tagList[$i] = $tag->id;
				}
			}
		}else{
			if((string)(int)$tagList !== $tagList){
				$tag = Tag::create(['name' => $tagList]);
				$tagList[$i] = $tag->id;
			}
		}
		$this->syncTags($article, $tagList);

		$message = 'Your article has been created.';
		flash( $message, 'success' );

		return redirect()->route( 'articles.index' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $article
	 * @return \Illuminate\Http\Response
	 */
	public function show(Article $article)
	{
		$images = $article->getMedia();
		if(!$images->isEmpty()){
			$imageUrl = $images[0]->getUrl();
		}else{
			$imageUrl = '';
		}
		return view( 'articles.show', compact( ['article', 'imageUrl'] ) );
	}

	/**
	 *
	 * @param Article $article
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Article $article)
	{
		$tags = Tag::pluck( 'name', 'id' );
		$tag_list = $article->tags()->orderBy('id')->get()->pluck('id')->toArray();
		return view( 'articles.edit', compact('article', 'tags', 'tag_list') );
	}

	/**
	 * @param ArticleRequest $request
	 * @param Article $article
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(ArticleRequest $request, Article $article)
	{
		$article->update( $request->all() );

		if($request->hasFile('image')){
			$article->clearMediaCollection();
			$article->addMediaFromRequest( 'image' )->toCollection( 'images' );
		}

		$this->syncTags( $article, $request->tag_list );

		$message = 'Article updated...';
		flash($message);

		return redirect()->route('articles.index');
	}

	/**
	 * @param Article $article
	 * @param array $tags
	 */
	private function syncTags(Article $article, array $tags){
		$article->tags()->sync( $tags );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		Article::findOrFail($id)->delete();

		$message = 'Article deleted...';
		flash( $message, 'danger' );

		return redirect()->route('articles.index');
	}
}