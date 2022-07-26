<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use Auth;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'post_id'
    ];
    
    public function getInfinityLikes($page, $like_id)
    {
        $limit = 2; // 一度に取得する件数
        $offset = $page * $limit; // 現在の取得開始位置
        return $this->with('post')->where('user_id', $like_id)->orderBy('updated_at', 'desc')->offset($offset)->limit($limit)->get();
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
