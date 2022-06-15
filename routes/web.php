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
Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'PostController@index');
    Route::get('/posts/{post}', 'PostController@comment');
    Route::get('/create', 'PostController@create');
    Route::post('/posts', 'PostController@store');
    Route::delete('/posts/{post}', 'PostController@delete');
    
    Route::get('/tools/{tool}', 'ToolController@index');
    
    Route::get('/user', 'UserController@index');
    Route::get('/favo', 'FavoriteController@index');
    Route::get('/bookmark', 'BookmarkController@index');
    Route::get('/map', 'MapController@index');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


