<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
