<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Tool extends Model
{
    public function getByTools(int $limit_count = 3)
    {
         return $this->posts()->with('tool')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
     public function getInfinityTools($page)
    {
        $limit = 2; // 一度に取得する件数
        $offset = $page * $limit; // 現在の取得開始位置
        return $this->posts()->with('tool', 'user')->orderBy('posts.created_at', 'desc')->offset($offset)->limit($limit)->get();
        
    }
    
    public function users()
    {
        return $this->hasMany('App\User');
    }
    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
