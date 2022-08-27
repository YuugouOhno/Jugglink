<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Like;
use App\Post;
use App\User;
use Carbon\Carbon;

use Auth;

class likeController extends Controller
{
    public function store(Post $post, Like $like)
    {
        $input_like = new Like();
        $input_like = ['user_id' =>(Auth::id()), 'post_id' => $post->id];
        $like->fill($input_like)->save();
        $count = $like->where('post_id', $post->id)->count();
        $result = true;
        return response()->json([
            'result' => $result,
            'count' => $count
        ]);
    }
    
    public function delete(Post $post, Like $like)
    {
        $like->where('post_id', $post->id)->where('user_id', Auth::id())->delete();
        $count = $like->where('post_id', $post->id)->count();
        $result = false;
        return response()->json([
            'result' => $result,
            'count' => $count
        ]);
    }
    
    public function countlikes(Post $post, Like $like) //以下追加
    {
        $post = Post::find($post->id);
        $count = $like->where('post_id', $post->id)->count();
        return response()->json($count);
    }
    
    public function haslikes(Post $post, Like $like)
    {
        $post = Post::find($post->id);
        if ($like->where('post_id', $post->id)->where('user_id', Auth::id())->count() != 0) {
            $result = true;
        } else {
            $result = false;
        }
        return response()->json($result);
    }
    
    public function index(User $user)
    {
        $datework = Carbon::createFromDate($user->start_date);
        $now = Carbon::now();
        $months = $datework->diffInMonths($now);
        $years = floor($months / 12);
        $months = $months % 12;
        return view('likes.index')->with(['user' => $user, 'years' => $years, 'months' => $months]);
    }
}
