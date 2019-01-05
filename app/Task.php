<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
