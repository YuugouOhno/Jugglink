<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Tool;
use App\Like;
use Storage;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    // public function index(User $user, Post $post)
    // {
    //     return view('users/index')->with(['user' => $user, 'posts' => $post->getPaginateByLimit()]);
    // }
    public function index(User $user, Request $request)
    {
        return view('users.index')->with(['user' => $user]);
    }
    
    public function fetch(Request $request, User $user) { // vueからのリクエスト
        $decodedFetchedPostIdList = json_decode($request->fetchedPostIdList, true); // すでに取得した投稿のIDリストを取得
        if (json_last_error() !== JSON_ERROR_NONE) { // jsonにエラーがあるときにエラーメッセージ
            return response()->json(['errorMessage' => json_last_error_msg()],500);
        }
        $posts = $this->extractShowPosts($decodedFetchedPostIdList, $request->page, $user); // 投稿を取得
        return response()->json(['posts' => $posts], 200); // 投稿のデータをvueへ
    }
    
    public function extractShowPosts($fetchedPostIdList, $page, $user) // 投稿を取得
    {
        $posts = $user->getInfinityUsers($page); // 一度に取得する件数,現在の取得開始位置の取得
        if (is_null($posts)) { // そもそも投稿が存在しない場合
            return []; // 何も返さない
        }
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
    
    public function edit(User $user, Tool $tool)
    {
        return view('users/edit')->with(['user'=>$user, 'tools'=>$tool->get()]);   
    }
    
    public function update(Request $request)
    {
        \Log::debug($request);
        $user = Auth::user();
       
        $icon = $request->file("file");
       
        $name = $request["name"];
        $tool_id = $request["tool_id"];
        $introduce = $request["introduce"];
        if($icon){ // 新しいアイコンを選択した場合
            // 解禁！！！
            \Log::debug('aaaaaaaa');
            if($user->icon_delete){ // 元々アイコンを選択していた場合
                $icon_delete = $user->icon_delete;
                Storage::disk('s3')->delete($icon_delete);
                $user->icon_delete = NULL;
                $user->icon_path = NULL;
            }
            // バケットの`icon`フォルダへアップロードする
            $path = Storage::disk('s3')->putFile('icon', $icon, 'public');
            // アップロードした画像のフルパスを取得
            $user->icon_path = Storage::disk('s3')->url($path);
            $user->icon_delete = $path;
        } 
        $input = [];
        if($name){
            $input += ['name' => $name];
        }
        if($tool_id){
            $input += ['tool_id' => $tool_id];
        }
        if($introduce){
            $input += ['introduce' => $introduce];
        }
        
        $user->fill($input)->save();
    }
}
