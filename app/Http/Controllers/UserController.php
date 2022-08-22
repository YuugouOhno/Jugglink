<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Tool;
use App\Like;
use App\FollowUser;
use Storage;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(User $user, Request $request)
    {
        $datework = Carbon::createFromDate($user->start_date);
        $now = Carbon::now();
        $months = $datework->diffInMonths($now);
        $years = floor($months / 12);
        $months = $months % 12;
        return view('users.index')->with(['user' => $user, 'years' => $years, 'months' => $months]);
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
    
    public function fetch(Request $request, User $user, FollowUser $followuser) { // vueからのリクエスト
        $fetchedUserIdList = json_decode($request->fetchedUserIdList, true); // すでに取得した投稿のIDリストを取得
        $page = $request->page;
        $tool_id = $request->tool_id;
        $user_name = $request->user_name;
        $following_id = $request->following_id;
        $followed_id = $request->followed_id;
        
        \Log::debug("フォロワー機能ううううううううううう");
        \Log::debug($request);
        $users = $this->searchUsers($fetchedUserIdList, $user, $followuser, $page, $tool_id, $user_name, $following_id, $followed_id); // 投稿を取得
        return response()->json(['users' => $users], 200); // 投稿のデータをvueへ
    }
    
    public function searchUsers($fetchedUserIdList, $user, $followuser, $page, $tool_id, $user_name, $following_id, $followed_id) // ユーザーを取得
    {
        $query = User::with('tool')->latest();
        $limit = 2; // 一度に取得する件数
        $offset = $page * $limit; // 現在の取得開始位置
        
        if($tool_id) {
            $query->where('tool_id', $tool_id);
        }
        
        if($user_name) {
            $query->where('name', 'LIKE', "%{$user_name}%");
        }
        
        if($following_id) {
            $query->where('tool_id', $tool_id);
        }
        
        if($following_id) {
            $follow_users= FollowUser::where('following_user_id', $following_id)->offset($offset)->limit($limit)->get(); // 一度に取得するいいね,現在の取得開始位置の取得
            $user_id = [];
            foreach ($follow_users as $follow_user) {
                $user_id[] = $follow_user->followed_user_id; // いいねした投稿のIDを取得
            }
            $users = User::with(['tool'])->find($user_id);
            if (is_null($fetchedUserIdList)) { // まだ取得した投稿が存在しない場合
                return $users; // 全部の投稿の中から取得した分を返す
            }
            return $users;
        }
        
        if($followed_id) {
            $follow_users= FollowUser::where('followed_user_id', $followed_id)->offset($offset)->limit($limit)->get(); // 一度に取得するいいね,現在の取得開始位置の取得
            $user_id = [];
            foreach ($follow_users as $follow_user) {
                $user_id[] = $follow_user->following_user_id; // いいねした投稿のIDを取得
            }
            $users = User::with(['tool'])->find($user_id);
            if (is_null($fetchedUserIdList)) { // まだ取得した投稿が存在しない場合
                return $users; // 全部の投稿の中から取得した分を返す
            }
            return $users;
        }
        
        $users = $query->offset($offset)->limit($limit)->get();
        
        if (is_null($users)) { // そもそも投稿が存在しない場合
            return []; // 何も返さない
        }
        if (is_null($fetchedUserIdList)) { // まだ取得した投稿が存在しない場合
            return $users; // 全部の投稿の中から取得した分を返す
        }
        return $users;
    }
}
