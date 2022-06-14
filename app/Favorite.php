<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function getFavoritePaginateByLimit(int $limit_count = 1)
    {
        $auths = Auth::id();
        return $this->$favorite->where('user_id', $auths)->posts()->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
