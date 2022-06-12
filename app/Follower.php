<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{public function user()
    {
        return $this->belongTo('ASpp\User');
    }
}
