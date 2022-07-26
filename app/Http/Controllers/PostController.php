<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tool;
use App\User;
use App\Comment;
use Auth;
use Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function getTools(Tool $tool)
    {
        return response()->json(['tools' => $tool->get()], 200); 
    }
    
    public function create(Tool $tool)
    {
        return view('posts/create')->with(['tools' => $tool->get()]);
    }
        
    public function store(Post $post, Request $request)
    {
        //\Log::debug(print_r($request, true));
        \Log::debug($request);
        
        $video = $request->file("file");
        $technique = $request["technique"];
        $tool_name = $request["tool_name"];
        $tool_id = Tool::where('tool_name',$tool_name)->value("id");
        $text = $request["text"];
        $tool_number = $request["tool_number"];
        
        // バケットの`example`フォルダへアップロードする
        $path = Storage::disk('s3')->putFile('video', $video, 'public');
        // アップロードした画像のフルパスを取得
        $post->video_path = Storage::disk('s3')->url($path);
        // 発明！！
        $post->video_delete = $path;
        
        $input = [];
        $input += ['user_id' => $request->user()->id];
        $input += ['tool_id' => $tool_id];
        $input += ['tool_number' => $tool_number];
        $input += ['technique' => $technique];
        $input += ['text' => $text];

        $post->fill($input)->save();
    }
    
    public function delete(Post $post, Request $request)
    {
        $video = $post->video_delete;
        Storage::disk('s3')->delete($video);
        $post->delete();
    }
    
    public function index()
    {
        return view('posts.index');
    }
}
?>