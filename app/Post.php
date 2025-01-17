<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Like;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'video',
        'technique',
        'tool_id',
        'tool_number',
        'text',
        'years'
    ];
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
    // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('tool', 'user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        //return $this::with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        //return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getInfinity($page)
    {
        $limit = 2; // 一度に取得する件数
        $offset = $page * $limit; // 現在の取得開始位置
        return $this::with('tool', 'user')->orderBy('posts.created_at', 'desc')->offset($offset)->limit($limit)->get();
        
    }
    
    public function getPosts($likepost)
    {
        return $this->with('tool', 'user')->get();
    }
    
    public function tool()
    {
        return $this->belongsTo('App\Tool');
    }
    
     public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function bookmarks()
    {
        return $this->hasmany('App\Bookmark');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function likes()
    {
        return $this->hasmany('App\Like');
    }
    
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
}
