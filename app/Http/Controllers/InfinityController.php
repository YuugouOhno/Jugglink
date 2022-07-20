<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tool;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class InfinityController extends Controller
{
    public function fetchAuth(Request $request) { // 認証データを取得
        $auth_user = Auth::user();
        return response()->json(['auth_user' => $auth_user], 200);
    }
    
    public function fetch(Request $request, Post $post) { // vueからのリクエスト
        $fetchedPostIdList = json_decode($request->fetchedPostIdList, true); // すでに取得した投稿のIDリストを取得
        // if (json_last_error() !== JSON_ERROR_NONE) { // jsonにエラーがあるときにエラーメッセージ
        //     return response()->json(['errorMessage' => json_last_error_msg()],500);
        // }
        $page = $request->page;
        $technique = $request->technique;
        $tool_id = $request->tool_id;
        $tool_number = $request->tool_number;
        $posts = $this->searchPosts($fetchedPostIdList, $post, $page, $technique, $tool_id, $tool_number); // 投稿を取得
        return response()->json(['posts' => $posts], 200); // 投稿のデータをvueへ
    }
    
    public function searchPosts($fetchedPostIdList, $post, $page, $technique, $tool_id, $tool_number) // 投稿を取得
    {
        $query = Post::with('tool','user')->latest();
        
        if($technique) {
            $query->where('technique', 'LIKE', "%{$technique}%");
        }
        
        if($tool_id) {
            $query->where('tool_id', $tool_id);
        }
        
        if($tool_number){
            $query->where('tool_number', $tool_number);
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
