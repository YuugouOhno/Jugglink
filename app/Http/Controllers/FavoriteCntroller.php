<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;

class FavoriteCntroller extends Controller
{
    public function index(Favorite $favorite)
    {
        return view('favorites.index')->with(['favo_posts' => $favorite->getFavoritePaginateByLimit()]);
    }
}
