<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Tool;

class SearchController extends Controller
{
    public function search_technique(Request $request, Tool $tool)
    {
        $query = Post::with('tool','user')->latest();
        
        //検索フォームに入力された値を取得
        $technique = $request->input('technique');
        $tool_name = $request->input('tool_name');
        $tool_id = Tool::where('tool_name', $tool_name)->value('id');
        $tool_number = $request->input('tool_number');
        $tool = $tool->get();
        return view('searches/technique')->with(['tools' => $tool, 'technique' => $technique, 'tool_id' => $tool_id, 'tool_number' => $tool_number]);
    }
    
    public function search_user(Request $request)
    {
        $query = User::with('tool')->latest();
         //検索フォームに入力された値を取得
        $tool_name = $request->input('tool_name');
        $tool_id = Tool::where('tool_name', $tool_name)->value('id');
        $user_name = $request->input('user_name');
        
        if($user_name) {
            $query->where('name', 'LIKE', "%{$user_name}%");
        }
        
        if($tool_id) {
            $query->where('tool_id', $tool_id);
        }
        
        $users = $query->get();
        
        $tool = Tool::all();
        
        return view('searches/user')->with(['users' => $users, 'tools' => $tool, 'user_name' => $user_name, 'tool_name' => $tool_name, 'tool_id' => $tool_id]);
    }
}
