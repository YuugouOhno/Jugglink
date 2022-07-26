<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'text',
        'post_id'
    ];
    
    public function getInfinityComment($page, $post_id){
        $limit = 2; // 一度に取得する件数
        $offset = $page * $limit; // 現在の取得開始位置
        return $this::with('post','user')->offset($offset)->limit($limit)->get();
    }
    
    public function getCommentPaginateByLimit(int $limit_count = 3)
    {
        return $this::with('post')->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
