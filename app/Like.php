<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'post_id'
    ];
    
    public function getLikePaginateByLimit(int $limit_count = 1)
    {
        $auths = Auth::id();
        return $this->$like->where('user_id', $auths)->posts()->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
