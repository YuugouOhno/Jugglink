<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'technique',
        'post_text',
        'tool_id',
        'user_id'
    ];
    
    public function getPaginateByLimit(int $limit_count = 1)
    {
    // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('tool')->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
        return $this->hasOne('App\Bookmark');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function favorites()
    {
        return $this->hasOne('App\Favorite');
    }
}
