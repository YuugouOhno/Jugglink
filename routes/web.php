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
    
    //投稿内容の作成画面
    Route::get('/posts/create/index', 'PostController@create')->name('posts.create.index');
    //投稿
    Route::post('/posts/create', 'PostController@store')->name('posts.create');
    //投稿の削除
    Route::delete('/posts/{post}/delete', 'PostController@delete')->name('posts.delete');
    //道具ごとの投稿
    Route::get('/tools/{tool}', 'ToolController@index')->name('tools.show');
    
    //コメント一覧＆コメントの作成
    Route::get('/posts/{post}/comments', 'PostController@comment')->name('comments.show');
    //コメントの投稿
    Route::post('/posts/{post}/comments/create', 'CommentController@store')->name('comments.create');
    //コメントの削除
    Route::delete('/posts/comments/{comment}/delete', 'CommentController@delete')->name('comments.delete');

    //プロフィール（自分の投稿一覧）
    Route::get('/users/{user}/profile/posts', 'UserController@index')->name('profile.posts');
    //プロフィール（自分のいいね一覧）
    Route::get('/users/{user}/profile/likes', 'LikeController@index')->name('profile.likes');
    //プロフィールの編集画面
    Route::get('/users/{user}/profile/edit', 'UserController@edit')->name('profile.edit');
    //プロフィールの変更
    Route::put('/users/{user}/profile/update', 'UserController@update')->name('profile.update');
    
    //いいね
    Route::get('/posts/{post}/likes', 'LikeController@store')->name('likes');
    //いいね解除
    Route::delete('/posts/{post}/unlikes', 'LikeController@delete')->name('unlikes');
    //いいね数のカウント
    Route::get('/posts/{post}/countlikes', 'LikeController@countlikes')->name('likes.count');
    //いいねの有無
    Route::get('posts/{post}/haslikes', 'LikeController@haslikes');
    
    //ブックマーク
    Route::get('/posts/{post}/bookmarks', 'BookmarkController@store')->name('bookmarks');
    //ブックマーク解除
    Route::delete('/posts/{post}/unbookmarks', 'BookmarkController@delete')->name('unbookmarks');
    //ブックマークの有無
    Route::get('posts/{post}/hasbookmarks', 'BookmarkController@hasbookmarks');
    
    //ジャグラー分布図
    Route::get('/map', 'MapController@index')->name('');

});

Auth::routes();

Route::get('/home', 'HomeController@index');


