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
    
    //無限スクロールはこれ一つにまとめていきたい（後々おいおい）
    Route::get('/infinity', 'InfinityController@fetch');
    //無限スクロールに認証
    Route::get('/infinityauth', 'InfinityController@fetchAuth');
    
    //ホーム画面
    Route::get('/', 'PostController@index')->name('home');
    //ホーム画面の無限スクロール
    Route::get('/infinity_posts/0', 'PostController@fetch');
    //投稿の検索
    Route::get('/search/index/technique/', 'SearchController@search_technique')->name('search.technique');
    //投稿の検索の無限スクロール
    Route::get('/infinity_search_technique/{user}', 'LikeController@fetch');
    //ユーザーの検索
    Route::get('/search/index/user/', 'SearchController@search_user')->name('search.user');
    
    //投稿
    Route::post('/posts/create', 'PostController@store')->name('posts.create');
    //投稿内容の作成画面
    Route::get('/posts/create/index', 'PostController@create')->name('posts.create.index');
    // 投稿モーダルにtoolwを取得
    Route::get('/gettool', 'PostController@getTools');
    //道具ごとの投稿一覧
    Route::get('/tools/{tool}', 'ToolController@index')->name('tools.show');
    //道具ごとの投稿一覧の無限スクロール
    Route::get('/infinity_tools/{tool}', 'ToolController@fetch');
    //投稿の削除
    Route::delete('/posts/{post}/delete', 'PostController@delete')->name('posts.delete');
    
    
    //コメント一覧＆コメントの作成
    Route::get('/posts/{post}/comments', 'CommentController@index')->name('comments.show');
    //コメントにある投稿の無限スクロール
    
    //コメントの投稿
    Route::post('/posts/{post}/comments/create', 'CommentController@store')->name('comments.create');
    //コメントの削除
    Route::delete('/posts/comments/{comment}/delete', 'CommentController@delete')->name('comments.delete');

    //プロフィール（ユーザーの投稿一覧）
    Route::get('/users/{user}/profile/posts', 'UserController@index')->name('profile.posts');
    //ユーザーの投稿一覧の無限スクロール
    Route::get('/infinity_users/{user}', 'UserController@fetch');
    //プロフィール（ユーザーのいいね一覧）
    Route::get('/users/{user}/profile/likes', 'LikeController@index')->name('profile.likes');
    //いいね一覧の無限スクロール
    Route::get('/infinity_likes/{user}', 'LikeController@fetch');
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
    Route::get('/posts/{post}/haslikes', 'LikeController@haslikes');
    
    //ブックマーク
    Route::get('/posts/{post}/bookmarks', 'BookmarkController@store')->name('bookmarks');
    //ブックマーク解除
    Route::delete('/posts/{post}/unbookmarks', 'BookmarkController@delete')->name('unbookmarks');
    //ブックマークの有無
    Route::get('/posts/{post}/hasbookmarks', 'BookmarkController@hasbookmarks');
    //ブックマークの一覧
    Route::get('/bookmarks/{user}/posts', 'BookmarkController@index')->name('bookmarks.show');
    //いいね一覧の無限スクロール
    Route::get('/infinity_bookmarks/{user}', 'BookmarkController@fetch');
    
    //ジャグラー分布図
    Route::get('/map', 'PlaceController@index')->name('map');
    Route::post('/map/addPin', 'PlaceController@store')->name('map.addPin');
    Route::delete('/map/delete', 'PlaceController@delete')->name('map.delete');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
