<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('articles', 'ArticlesController');
Route::resource('tags', 'TagsController');

Auth::routes();

Route::get('/account/contacts', 'ContactsController@create')->name('registerUser');
Route::post('/account/contacts', 'ContactsController@store')->name('storeUser');

Route::get('/dialog', 'ArticlesController@dialog')->name('dialog');
Route::get('/filemanager', 'ArticlesController@fileManager')->name('fileManager');
Route::post('/uploads', 'ArticlesController@uploadImages')->name('uploadImages');

Route::get('/', 'ArticlesController@index')->name('articles');
Route::get('/unpublished-articles', 'ArticlesController@indexUnPublished')->name('unpublished');

Route::get( '/tags/{tag}', 'TagsController@showTaggedArticles' )->name('articlesTagged');

Route::get('/home', 'HomeController@index')->name('dashboard');
Route::get( '/about', 'HomeController@about' )->name( 'about' );
Route::get( '/contact', 'HomeController@contact' )->name( 'contact' );

Route::get('/home', 'HomeController@index')->name('home');
