<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Tool;

class SearchController extends Controller
{
    public function search_technique(Request $request)
    {
        //検索フォームに入力された値を取得
        $tool_name = $request->input('tool_name');
        $tool_number = $request->input('tool_number');
        $technique = $request->input('technique');
        
        $query = Post::query();
        
        //テーブル結合
        $query->join('users', function ($query) use ($request) {
            $query->on('posts.user_id', '=', 'users.id');
        })->join('tools', function ($query) use ($request) {
            $query->on('posts.tool_id', '=', 'tools.id');
        });
        
        if(!empty($technique)) {
            $query->where('technique', 'LIKE', "%{$technique}%");
        }
        
        if(!empty($tool_name)) {
            $query->where('tool_name', 'LIKE', $tool_name);
        }
        
        if(!empty($tool_number)){
            $query->where('tool_number', 'LIKE', $tool_number);
        }
        
        $items = $query->get();

        $tool = Tool::all();
        
        return view('searches/technique')->with(['items' => $items, 'tools' => $tool, 'technique' => $technique, 'tool_name' => $tool_name, 'tool_number' => $tool_number]);
    }
    
    public function search_user(Request $request)
    {
         //検索フォームに入力された値を取得
        $tool_name = $request->input('tool_name');
        $user_name = $request->input('user_name');
        
        $query = User::query();
        
        //テーブル結合
        $query->join('tools', function ($query) use ($request) {
            $query->on('users.tool_id', '=', 'tools.id');
        });
        
        if(!empty($user_name)) {
            $query->where('name', 'LIKE', "%{$user_name}%");
        }
        
        if(!empty($tool_name)) {
            $query->where('tool_name', 'LIKE', $tool_name);
        }
        
        $items = $query->get();

        $tool = Tool::all();
        
        return view('searches/user')->with(['items' => $items, 'tools' => $tool, 'user_name' => $user_name, 'tool_name' => $tool_name]);
    }
}
