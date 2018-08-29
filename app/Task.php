<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function member()
    {
        return $this->belongsTo('App\Member');
    }
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function week()
    {
        return $this->belongsTo('App\Week');
    }
}
