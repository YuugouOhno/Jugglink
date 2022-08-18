<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\Http\Requests\CommentRequest;


class CommentController extends Controller
{
    public function index(Post $post, Comment $comment)
    {
        return view('posts/comment')->with(['post' => $post, 'comments' => $comment->getCommentPaginateByLimit()]);
    }
    
    public function store(Comment $comment, Post $post, Request $request)
    {
        $text = $request['text'];
        $post_id = $request["post_id"];
    
        $input = [];
        $input += ['user_id' => $request->user()->id];
        $input += ['text' => $text];
        $input += ['post_id' => $post_id];
        $comment->fill($input)->save();
    }
    
    public function delete(Comment $comment)
    {
        $comment->delete();
    }
    
    public function fetch(Request $request, Post $post, Comment $comment) { // vueからのリクエスト
        $fetchedCommentIdList = json_decode($request->fetchedCommentIdList, true); // すでに取得した投稿のIDリストを取得
        $page = $request->page;
        $post_id = $request->post_id;
        $comments = $this->searchComments($fetchedCommentIdList, $post, $comment, $page, $post_id); // 投稿を取得
        return response()->json(['comments' => $comments], 200); // 投稿のデータをvueへ
    }
    
    public function searchComments($fetchedCommentIdList, $post, $comment, $page, $post_id) // 投稿を取得
    {
        $query = Comment::with('post','user')->latest();
        $query->where('post_id', $post_id);
 
        $limit = 10; // 一度に取得する件数
        $offset = $page * $limit; // 現在の取得開始位置
        $comments = $query->offset($offset)->limit($limit)->get();
        \Log::debug($comments);
        
        if (is_null($comments)) { // そもそも投稿が存在しない場合
            return []; // 何も返さない
        }
        if (is_null($fetchedCommentIdList)) { // まだ取得した投稿が存在しない場合
            return $comments; // 全部の投稿の中から取得した分を返す
        }
        return $comments;
    }
    
}
