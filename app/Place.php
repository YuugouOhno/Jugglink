<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
