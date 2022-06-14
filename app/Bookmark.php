<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public function getBookmarkPaginateByLimit(int $limit_count = 1)
    {
        $auths = Auth::id();
        return $this->$bookmark->where('user_id', $auths)->posts()->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
