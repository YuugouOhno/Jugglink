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
    // public function index(Post $post, Comment $comment)
    // {
    //     return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);
    // }
    
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
        // $showablePosts = []; // 既に取得した投稿が存在する場合
        // foreach ($posts as $post) {
        //     if (!in_array($post->id, $fetchedPostIdList)) { // 新たに取得した投稿が被っていないことを確認して取得
        //         $showablePosts[] = $post;
        //     }
        // }
        // return $showablePosts;
        return $posts;
    }
    
    
}
?>