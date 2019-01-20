<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function parent()
    {
        return $this->belongsTo('App\Work');
    }

    public function works()
    {
       return $this->belongsToMany('App\Work');
    }
}
