<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'post_id'
    ];
    
    public function getByLike(int $limit_count = 3)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
