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
        'text'
    ];
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
    // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('tool', 'user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        //return $this::with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        //return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
