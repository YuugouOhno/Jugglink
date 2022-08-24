<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tool;
use App\User;
use App\Like;
use App\Bookmark;
use Auth;
use Illuminate\Support\Facades\DB;

class InfinityController extends Controller
{
    public function fetchAuth(Request $request) { // 認証データを取得
        $auth_id = Auth::id();
        $auth_user = User::with('tool')->find($auth_id);
        return response()->json(['auth_user' => $auth_user], 200);
    }
    
    public function fetch(Request $request, Post $post, Like $like, Bookmark $bookmark) { // vueからのリクエスト
        $fetchedPostIdList = json_decode($request->fetchedPostIdList, true); // すでに取得した投稿のIDリストを取得
        
        $page = $request->page;
        $technique = $request->technique;
        $tool_id = $request->tool_id;
        $tool_number = $request->tool_number;
        $user_id = $request->user_id;
        $like_id = $request->like_id;
        $bookmark_id = $request->bookmark_id;
        $minyear = $request->minyear;
        $maxyear = $request->maxyear;
        $posts = $this->searchPosts($fetchedPostIdList, $post, $like, $bookmark, $page, $technique, $tool_id, $tool_number, $user_id, $like_id, $bookmark_id, $minyear, $maxyear); // 投稿を取得
        return response()->json(['posts' => $posts], 200); // 投稿のデータをvueへ
    }
    
    public function searchPosts($fetchedPostIdList, $post, $like, $bookmark, $page, $technique, $tool_id, $tool_number, $user_id, $like_id, $bookmark_id, $minyear, $maxyear) // 投稿を取得
    {
        $query = Post::with('tool','user')->latest();
        
        if($technique) {
            $query->where('technique', 'LIKE', "%{$technique}%");
        }
        
        if($tool_id) {
            $query->where('tool_id', $tool_id);
        }
        
        if($tool_number) {
            $query->where('tool_number', $tool_number);
        }
        
        if($minyear) {
            $query->where('years', '>=', $minyear);
        }
        
        if($maxyear) {
            $query->where('years', '<=', $maxyear);
        }
        
        if($user_id) {
            $query->where('user_id', $user_id);
        }
        
        if($like_id) {
            $likes = $like->getInfinityLikes($page, $like_id); // 一度に取得するいいね,現在の取得開始位置の取得
            $post_id = [];
            foreach ($likes as $like) {
                $post_id[] = $like->post_id; // いいねした投稿のIDを取得
            }
            $posts = Post::with(['user', 'tool'])->find($post_id);
            if (is_null($fetchedPostIdList)) { // まだ取得した投稿が存在しない場合
                return $posts; // 全部の投稿の中から取得した分を返す
            }
            return $posts;
        }
        
        if($bookmark_id) {
            $bookmarks = $bookmark->getInfinityBookmarks($page, $bookmark_id); // 一度に取得するいいね,現在の取得開始位置の取得
            $post_id = [];
            foreach ($bookmarks as $bookmark) {
                $post_id[] = $bookmark->post_id; // いいねした投稿のIDを取得
            }
            $posts = Post::with(['user', 'tool'])->find($post_id);
            if (is_null($fetchedPostIdList)) { // まだ取得した投稿が存在しない場合
                return $posts; // 全部の投稿の中から取得した分を返す
            }
            return $posts;
        }
        
        $limit = 2; // 一度に取得する件数
        $offset = $page * $limit; // 現在の取得開始位置
        $posts = $query->offset($offset)->limit($limit)->get();
        
        if (is_null($posts)) { // そもそも投稿が存在しない場合
            return []; // 何も返さない
        }
        if (is_null($fetchedPostIdList)) { // まだ取得した投稿が存在しない場合
            return $posts; // 全部の投稿の中から取得した分を返す
        }
        return $posts;
    }
}
