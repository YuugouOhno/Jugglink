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
    
    //投稿の無限スクロール
    Route::get('/infinity', 'InfinityController@fetch');
    //ユーザーの無限スクロール
    Route::get('/infinity_user', 'UserController@fetch');
    //コメントの無限スクロール
    Route::get('/infinity_comment', 'CommentController@fetch');
    //無限スクロールに認証
    Route::get('/infinityauth', 'InfinityController@fetchAuth');
    
    //ホーム画面
    Route::get('/', 'PostController@index')->name('home');
    
    //投稿の検索
    Route::get('/search/index/technique/', 'SearchController@search_technique')->name('search.technique');
    //ユーザーの検索
    Route::get('/search/index/user/', 'SearchController@search_user')->name('search.user');
    
    //投稿
    Route::post('/posts/create', 'PostController@store')->name('posts.create');
    //投稿内容の作成画面
    Route::get('/posts/create/index', 'PostController@create')->name('posts.create.index');
    // 投稿モーダルにtoolを取得
    Route::get('/gettool', 'PostController@getTools');
    //道具ごとの投稿一覧
    Route::get('/tools/{tool}', 'ToolController@index')->name('tools.show');
    //投稿の削除
    Route::delete('/posts/{post}/delete', 'PostController@delete')->name('posts.delete');
    
    //コメント一覧＆コメントの作成
    Route::get('/posts/{post}/comments', 'CommentController@index')->name('comments.show');
    //コメントの投稿
    Route::post('/posts/comments/create', 'CommentController@store')->name('comments.create');
    //コメントの削除
    Route::delete('/comments/{comment}/delete', 'CommentController@delete')->name('comments.delete');

    //プロフィール（ユーザーの投稿一覧）
    Route::get('/users/{user}/profile/posts', 'UserController@index')->name('profile.posts');
    //プロフィール（ユーザーのいいね一覧）
    Route::get('/users/{user}/profile/likes', 'LikeController@index')->name('profile.likes');
    //プロフィールの編集画面
    Route::get('/users/{user}/profile/edit', 'UserController@edit')->name('profile.edit');
    //プロフィールの変更
    Route::post('/users/profile/update', 'UserController@update')->name('profile.update');
    
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
    
    //ジャグラー分布図
    Route::get('/map', 'PlaceController@index')->name('map');
    //ピンの追加
    Route::post('/map/addPin', 'PlaceController@store')->name('map.addPin');
    //ピンの削除
    Route::delete('/map/delete', 'PlaceController@delete')->name('map.delete');
    
    //フォロー
    Route::get('/users/{user}/follow', 'FollowUserController@store');
    //フォロー解除
    Route::delete('/users/{user}/unfollow', 'FollowUserController@delete');
    //フォローフォロワーのカウント
    Route::get('/users/{user}/countfollows', 'FollowUserController@countfollows');
    //フォロワーの有無
    Route::get('/users/{user}/hasfollowed', 'FollowUserController@hasfollowed');
});

//ウルカムページ
Route::get('/welcome', 'PostController@home')->name('welcome');

Auth::routes();

