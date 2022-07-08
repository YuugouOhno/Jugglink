<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;
use App\Post;
use App\User;
use Auth;

class BookmarkController extends Controller
{
    public function store(Post $post, Bookmark $bookmark)
    {
        $input_bookmark = new Bookmark();
        $input_bookmark = ['user_id' =>(Auth::id()), 'post_id' => $post->id];
        $bookmark->fill($input_bookmark)->save();
        $result = true;
        return response()->json([
            'result' => $result,
        ]);
    }
    
    public function delete(Post $post, Bookmark $bookmark)
    {
        $bookmark->where('post_id', $post->id)->where('user_id', Auth::id())->delete();
        $result = false;
        return response()->json([
            'result' => $result,
        ]);
    }
    
    public function hasbookmarks(Post $post, Bookmark $bookmark)
    {
        $post = Post::find($post->id);
        if ($bookmark->where('post_id', $post->id)->where('user_id', Auth::id())->count() != 0) {
            $result = true;
        } else {
            $result = false;
        }
        return response()->json($result);
    }
    
    public function index(Request $request, Bookmark $bookmark, User $user)
    {
        $bookmarks = $bookmark->getByBookmarks();
        return view('bookmarks.index')->with(['user' => $user, 'bookmarks' => $bookmarks]);
    }
}
