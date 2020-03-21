<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class parentTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:parentTasks {mockUrl}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add to parent task from mock url';

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
        $url = $this->argument('mockUrl');
        dd($url);
    }
}
