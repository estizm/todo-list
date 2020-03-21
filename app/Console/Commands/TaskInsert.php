<?php

namespace App\Console\Commands;

use App\Tasks;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Helpers\ServiceHelper;

class TaskInsert extends Command
{
    use ServiceHelper;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:TaskInsert {mockUrl*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add to task from mock url';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        try {
            $url = $this->argument('mockUrl');
            $tasks = $this->getService($url[0]);
            $parentTask = $this->getService($url[1]);
            $taskDecode = json_decode( json_encode($tasks),true);
            $parentTaskDecode = json_decode(json_encode($parentTask),true);
            $user = User::all();
            foreach ($user as $users){
                $parentQuery = \App\ParentTasks::where('user_id', $users->id)->get();
                $userTime = \App\ParentTasks::where('user_id',$users->id)->sum('time');
                if (!$userTime>=45){

                    foreach ($taskDecode as $list => $key) {
                        foreach ($key as $value){
                            $tasks = new Tasks;
                            $tasks->name = "Business Task " .$list;
                            $tasks->level = $value['level'];
                            $tasks->estimated_duration = $value['estimated_duration'];
                            $tasks->save();
                            $parentTask = new \App\ParentTasks;
                            $parentTask->difficulty = $parentTaskDecode[$list]['zorluk'];
                            $parentTask->time = $parentTaskDecode[$list]['sure'];
                            $parentTask->parent_task_id = $list+1;
                            $parentTask->user_id = $users->id;
                            $parentTask->save();

                            //daily user working 5 hour
                        }
                    }
                }else{
                    dd('error');
                }
            }

        } catch (\Exception $error) {
            dd($error);
        }
    }
}
