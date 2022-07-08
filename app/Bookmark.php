<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use Auth;

class Bookmark extends Model
{
    protected $fillable = [
        'user_id',
        'post_id'
    ];
    
    public function getByBookmarks()
    {
        return $this->with('post')->where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
