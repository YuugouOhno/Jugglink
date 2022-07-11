<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tool;
use App\Comment;
use Storage;

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
    
    public function delete(Post $post)
    {
        $video = $post->video_delete;
        Storage::disk('s3')->delete($video);
        $post->delete();
        return redirect()->route('home');
    }
    
    public function index()
    {
        // 仮で画面を返す処理のみにする
        return view('posts.test');
    }

    public function fetch(Request $request) {
        $decodedFetchedTweetIdList = json_decode($request->fetchedTweetIdList, true); 
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['errorMessage' => json_last_error_msg()],500);
        }
        // ツイートを取得
        $posts = $this->extractShowTweets($decodedFetchedTweetIdList, $request->page);

        return response()->json(['posts' => $posts], 200);
    }
    
    public function extractShowTweets($fetchedTweetIdList, $page)
    {
        $limit = 10; // 一度に取得する件数
        $offset = $page * $limit; // 現在の取得開始位置
        $tweets = Post::orderBy('created_at', 'desc')->offset($offset)->take($limit)->get();
        if (is_null($tweets)) {
            return [];
        }

        if (is_null($fetchedTweetIdList)) {
            return $tweets;
        }

        $showableTweets = [];
        foreach ($tweets as $tweet) {
            if (!in_array($tweet->id, $fetchedTweetIdList)) {
                $showableTweets[] = $tweet;
            }
        }

        return $showableTweets;
    }
}
?>