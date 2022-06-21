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
    Route::get('/', 'PostController@index')->name('home');
    
    //コメント一覧＆コメントの作成
    Route::get('/posts/{post}/comments', 'PostController@comment')->name('comments.create');
    //コメントの投稿
    Route::post('/posts/{post}/comment/create', 'CommentController@store')->name('');
    //コメントの削除
    Route::delete('/posts/{post}/comment/delete', 'CommentController@delete')->name('');
    
    //投稿内容の作成画面
    Route::get('/posts/create/index', 'PostController@create')->name('posts.create.index');
    //投稿
    Route::post('/posts/create', 'PostController@store')->name('');
    //投稿の削除
    Route::delete('/posts/{post}/delete', 'PostController@delete')->name('');
    //道具ごとの投稿
    Route::get('/tools/{tool}', 'ToolController@index')->name('');
    
    //プロフィール（自分の投稿一覧）
    Route::get('/users/{user}/profile/posts', 'UserController@index')->name('profile.posts');
    //プロフィールの編集画面
    Route::get('/users/{user}/profile/edit', 'UserController@edit')->name('');
    //プロフィールの変更
    Route::put('/users/{user}/profile', 'UserController@update')->name('');
    
    //いいね
    Route::post('/posts/{post}/like', 'LikeController@like')->name('');
    //ブックマーク
    Route::get('/posts/{post}/bookmark', 'BookmarkController@index')->name('');
    //ジャグラー分布図
    Route::get('/map', 'MapController@index')->name('');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


