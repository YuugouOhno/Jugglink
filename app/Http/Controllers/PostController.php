<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tool;
use App\Comment;

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
        $input = $request['post'];
        $input += ['user_id' => $request->user()->id];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }

}
?>