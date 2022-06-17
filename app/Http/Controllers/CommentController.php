<?php

namespace App\Http\Controllers;


use App\Comment;
use App\Post;

use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(Comment $comment, Post $post, CommentRequest $request)
    {
        $input = $request['comment'];
        $input += ['user_id' => $request->user()->id];
        $input += [$post->id];
        $comment->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
}
