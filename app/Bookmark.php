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
    
    public function getInfinityBookmarks($page, $user)
    {
        $limit = 2; // 一度に取得する件数
        $offset = $page * $limit; // 現在の取得開始位置
        return $this->with('post')->where('user_id', $user)->orderBy('updated_at', 'desc')->offset($offset)->limit($limit)->get();
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
