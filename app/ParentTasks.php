<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentTasks extends Model
{
    protected $table = "parent_task";

    public function task(){
        return $this->belongsTo('App\Tasks');
    }

    public function user()
    {
        return $this->hasMany('App\User','id');
    }
}
