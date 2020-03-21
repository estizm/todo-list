<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table="tasks";


    public function parent(){
        return $this->hasOne('App\ParentTasks','parent_task_id');
    }


}
