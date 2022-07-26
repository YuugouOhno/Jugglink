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
    public function index(User $user, Request $request)
    {
        return view('users.index')->with(['user' => $user]);
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
