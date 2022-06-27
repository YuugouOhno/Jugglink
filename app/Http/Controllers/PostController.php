<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tool;
use App\Comment;
use Storage;

use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    public function comment(Post $post, Comment $comment)
    {
        return view('posts/comment')->with(['post' => $post, 'comments' => $comment->getCommentPaginateByLimit()]);
    }
    
    public function create(Tool $tool)
    {
        return view('posts/create')->with(['tools' => $tool->get()]);
    }
        
    public function store(Post $post, PostRequest $request)
    {

        $image = $request->file('video');

        // バケットの`example`フォルダへアップロードする
        $path = Storage::disk('s3')->putFile('video', $image, 'public');
        // アップロードした画像のフルパスを取得
        $post->video_path = Storage::disk('s3')->url($path);
        // 発明！！
        $post->video_delete = $path;
        $input = $request['post'];
        $input += ['user_id' => $request->user()->id];
        // $input += ['video_path' => Storage::disk('s3')->url($path)];
        $post->fill($input)->save();
        return redirect()->route('home');
    }
    
    public function delete(Post $post)
    {
        $video = $post->video_delete;
        Storage::disk('s3')->delete($video);
        $post->delete();
        return redirect()->route('home');
    }
}
?>