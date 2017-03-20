<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class closeExpiredMeetings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meetings:closeExpired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close all expired meeting requests';

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
        $now = new DateTime();
        foreach(App\Meeting::where('end_time', '<', $now) as $meeting){
            $meeting->expired = true;
        }
    }
}
