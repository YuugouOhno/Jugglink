<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tool;
use App\User;
use Illuminate\Support\Facades\DB;

class InfinityController extends Controller
{
    public function fetchAuth(Request $request) { // 認証データを取得
        $auth_user = Auth::id();
        return response()->json(['auth_user' => $auth_user], 200);
    }
    
    public function fetch(Request $request, Post $post) { // vueからのリクエスト
        $decodedFetchedPostIdList = json_decode($request->fetchedPostIdList, true); // すでに取得した投稿のIDリストを取得
        if (json_last_error() !== JSON_ERROR_NONE) { // jsonにエラーがあるときにエラーメッセージ
            return response()->json(['errorMessage' => json_last_error_msg()],500);
        }
        $posts = $this->extractShowPosts($decodedFetchedPostIdList, $request->page, $post); // 投稿を取得
        return response()->json(['posts' => $posts], 200); // 投稿のデータをvueへ
    }
    
    public function extractShowPosts($fetchedPostIdList, $page, $post) // 投稿を取得
    {
        $posts = $post ->getInfinity($page); // 一度に取得する件数,現在の取得開始位置の取得
        if (is_null($posts)) { // そもそも投稿が存在しない場合
            return []; // 何も返さない
        }
        if (is_null($fetchedPostIdList)) { // まだ取得した投稿が存在しない場合
            return $posts; // 全部の投稿の中から取得した分を返す
        }
        return $posts;
    }
}
