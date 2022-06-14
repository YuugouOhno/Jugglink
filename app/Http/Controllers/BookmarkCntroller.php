<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;

class BookmarkCntroller extends Controller
{
    public function index(Bookmark $bookmark)
    {
        return view('bookmarks.index')->with(['bookmark_posts' => $bookmark->getBookmarkPaginateByLimit()]);
    }
}
