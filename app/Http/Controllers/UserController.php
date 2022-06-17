<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class UserController extends Controller
{
    public function index(User $user, Post $post)
    {
        return view('users.index')->with(['user' => $user, 'posts' => $post->getPaginateByLimit()]);
    }
}
