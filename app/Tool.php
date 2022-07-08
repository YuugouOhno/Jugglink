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
    
    public function users()
    {
        return $this->hasMany('App\User');
    }
    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
