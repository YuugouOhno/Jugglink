<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;
use App\Post;
use App\User;
use Auth;

class BookmarkController extends Controller
{
    public function store(Post $post, Bookmark $bookmark)
    {
        $input_bookmark = new Bookmark();
        $input_bookmark = ['user_id' =>(Auth::id()), 'post_id' => $post->id];
        $bookmark->fill($input_bookmark)->save();
        $result = true;
        return response()->json([
            'result' => $result,
        ]);
    }
    
    public function delete(Post $post, Bookmark $bookmark)
    {
        $bookmark->where('post_id', $post->id)->where('user_id', Auth::id())->delete();
        $result = false;
        return response()->json([
            'result' => $result,
        ]);
    }
    
    public function hasbookmarks(Post $post, Bookmark $bookmark)
    {
        $post = Post::find($post->id);
        if ($bookmark->where('post_id', $post->id)->where('user_id', Auth::id())->count() != 0) {
            $result = true;
        } else {
            $result = false;
        }
        return response()->json($result);
    }
    
    public function index(User $user)
    {
        return view('bookmarks.index')->with(['user' => $user]);
    }
    
    public function fetch(Request $request, Bookmark $bookmark, Post $post, $user) { // vueからのリクエスト
        $decodedFetchedPostIdList = json_decode($request->fetchedPostIdList, true); // すでに取得した投稿のIDリストを取得
        if (json_last_error() !== JSON_ERROR_NONE) { // jsonにエラーがあるときにエラーメッセージ
            return response()->json(['errorMessage' => json_last_error_msg()],500);
        }
        $posts = $this->extractShowPosts($decodedFetchedPostIdList, $request->page, $bookmark, $post, $user); // 投稿を取得
        return response()->json(['posts' => $posts], 200); // 投稿のデータをvueへ
    }
    
    public function extractShowPosts($fetchedPostIdList, $page, Bookmark $bookmark, Post $post, $user) // 投稿を取得
    {
        $bookmarks = $bookmark->getInfinityBookmarks($page, $user); // 一度に取得するいいね,現在の取得開始位置の取得
        $post_id = [];
        foreach ($bookmarks as $bookmark) {
            $post_id[] = $bookmark->post_id; // いいねした投稿のIDを取得
        }
        
        $posts = Post::with(['user', 'tool'])->find($post_id); // 投稿のIDから投稿を取得
        
        if (is_null($fetchedPostIdList)) { // まだ取得した投稿が存在しない場合
            return $posts; // 全部の投稿の中から取得した分を返す
        }
        // $showablePosts = []; // 既に取得した投稿が存在する場合
        // foreach ($posts as $post) {
        //     if (!in_array($post->id, $fetchedPostIdList)) { // 新たに取得した投稿が被っていないことを確認して取得
        //         $showablePosts[] = $post;
        //     }
        // }
        // return $showablePosts;
        return $posts;
    }
}
