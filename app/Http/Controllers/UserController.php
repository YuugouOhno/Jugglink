<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Tool;
use App\Like;
use Storage;

use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index(User $user, Post $post)
    {
        return view('users/index')->with(['user' => $user, 'posts' => $post->getPaginateByLimit()]);
    }
    
    public function edit(User $user, Tool $tool)
    {
        return view('users/edit')->with(['user'=>$user, 'tools'=>$tool->get()]);   
    }
    
    public function update(UserRequest $request, User $user)
    {
        // 解禁！！！
        if($user->icon_delete != 0)
        {
            $icon = $user->icon_delete;
            Storage::disk('s3')->delete($icon);
        }
        
        $image = $request->file('icon');
        
        $user_id= $user->id;
        
        // // バケットの`example`フォルダへアップロードする
        $path = Storage::disk('s3')->putFile('icon/'.$user_id, $image, 'public');
       
        $input_user = $request['user'];
         // // アップロードした画像のフルパスを取得
        $user->icon_path = Storage::disk('s3')->url($path);
        $user->icon_delete = $path;
        
        $user->fill($input_user)->save();
        return redirect()->route('profile.posts', ['user'=>$user->id]);
    }
}
