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
    //ホーム画面
    Route::get('/', 'PostController@index');
    //コメント
    Route::get('/posts/{post}', 'PostController@comment');
    Route::post('/comment', 'CommentController@store');
    //投稿の作成削除
    Route::get('/create', 'PostController@create');
    Route::post('/posts', 'PostController@store');
    Route::delete('/posts/{post}', 'PostController@delete');
    //道具ごと
    Route::get('/tools/{tool}', 'ToolController@index');
    //プロフィール
    Route::get('/profiles/users/{user}', 'UserController@index');
    //いいね
    Route::get('/favorite', 'FavoriteController@index');
    Route::get('/bookmark', 'BookmarkController@index');
    Route::get('/map', 'MapController@index');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


