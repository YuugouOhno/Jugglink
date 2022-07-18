<?php

namespace App\Http\Controllers;


use App\Comment;
use App\Post;

use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function index(Post $post, Comment $comment)
    {
        return view('posts/comment')->with(['post' => $post, 'comments' => $comment->getCommentPaginateByLimit()]);
    }
    
    public function store(Comment $comment, Post $post, CommentRequest $request)
    {
        $input_comment = $request['comment'];
        $input_comment += ['user_id' => $request->user()->id];
        $input_comment += ['post_id' => $post->id];
        $comment->fill($input_comment)->save();
        
        return redirect()->route('comments.show', ['post' => ($post->id)]);
    }
    
    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comments.show', ['post' => ($comment->post->id)]);
    }
    
}
