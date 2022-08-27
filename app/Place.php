<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    protected $fillable = [
        'user_id',
        'latitude',
        'longitude'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
