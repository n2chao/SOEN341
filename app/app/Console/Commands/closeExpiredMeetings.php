<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CloseExpiredMeetings extends Command
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
    protected $description = 'Close all expired meetings';

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
     * Close all expired meetings.
     *      Soft delete all meetings having occured in the past.
     *
     */
    public function handle()
    {
        $now = new \DateTime();
        $meetings = \App\Meeting::where('end_time', '<', $now)->get();
        foreach($meetings as $meeting){
            //soft delete the meeting and associated attendances
            foreach($meeting->attendances as $attendance){
                $attendance->delete();
            }
            $meeting->delete();
        }
    }
}
