<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Tool;

use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index(User $user, Post $post)
    {
        return view('users/index')->with(['user' => $user, 'posts' => $post->getPaginateByLimit()]);
    }
    
    public function edit(User $user, Tool $tool)
    {
        return view('users/edit')->with(['user'=>$user, 'tools'=>$tool->get()]);   
    }
    
    public function update(UserRequest $request, User $user)
    {
        $input_user = $request['user'];
        $user->fill($input_user)->save();
        return redirect()->route('profile.posts', ['user'=>$user->id]);
    }
}
