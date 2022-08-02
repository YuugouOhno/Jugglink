<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\FollowUser;

class FollowUserController extends Controller
{
    public function store(User $user) {
        \Log::debug("aaaaaaa");
        
        $follow = FollowUser::create([
            'following_user_id' => \Auth::user()->id,
            'followed_user_id' => $user->id,
        ]);
        \Log::debug($follow);
        $followedCount = count(FollowUser::where('followed_user_id', $user->id)->get());
        $result = true;
        return response()->json([
            'result' => $result,
            'followedCount' => $followedCount
        ]);
    }

    public function delete(User $user) {
        $follow = FollowUser::where('following_user_id', \Auth::user()->id)->where('followed_user_id', $user->id)->first();
        $follow->delete();
        $followedCount = count(FollowUser::where('followed_user_id', $user->id)->get());
        $result = false;
        return response()->json([
            'result' => $result,
            'followedCount' => $followedCount
        ]);
    }
    
    public function countfollows(User $user) //以下追加
    {
        $followedCount = count(FollowUser::where('followed_user_id', $user->id)->get());
        $followingCount = count(FollowUser::where('following_user_id', $user->id)->get());
        if(!$followingCount){
            $followingCount = 0;
        }
        return response()->json([
            'followedCount' => $followedCount,
            'followingCount' => $followingCount
        ]);
    }
    
    public function hasfollowed(User $user)
    {
        $follow = FollowUser::where('following_user_id', \Auth::user()->id)->where('followed_user_id', $user->id)->first();
        if ($follow) {
            $result = true;
        } else {
            $result = false;
        }
        return response()->json($result);
    }
}
