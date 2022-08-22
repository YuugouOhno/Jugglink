<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icon','name', 'email', 'password','tool_id', 'start_date', 'introduce'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // public function getOwnPaginateByLimit(int $limit_count = 3)
    // {
    //     return $this::with('posts')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    // }
    
    public function getInfinityUsers($page)
    {
        $limit = 2; // 一度に取得する件数
        $offset = $page * $limit; // 現在の取得開始位置
        return $this->posts()->with('tool', 'user')->orderBy('posts.created_at', 'desc')->offset($offset)->limit($limit)->get();
    }
    
    // フォロワー→フォロー フォロワーを取得
    public function followUsers()
    {
        return $this->belongsToMany('App\User', 'follow_users', 'followed_user_id', 'following_user_id');
    }

    // フォロー→フォロワー フォローしているユーザーを取得
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follow_users', 'following_user_id', 'followed_user_id');
    }
    // 第一引数には使用するモデル
    // 第二引数には使用するテーブル名
    // 第三引数にはリレーションを定義しているモデルの外部キー名
    // 第四引数には結合するモデルの外部キー名
    
    public function tool()
    {
        return $this->belongsTo('App\Tool');
    }
    
    public function bookmarks()
    {
        return $this->hasMany('App\Bookmark');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    
    public function followers()
    {
        return $this->hasMany('App\Follower');
    }
    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    
    public function places()
    {
        return $this->hasMany('App\Place');
    }
}
