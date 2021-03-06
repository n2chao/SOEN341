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
     *      Soft delete all attendances associated with the meeting.
     */
    public function handle()
    {
        date_default_timezone_set("America/New_York");
        $now = new \DateTime();
        // $this->info(var_dump($now));     output to console
        $meetings = \App\Meeting::where('end_time', '<', $now)->get();
        foreach($meetings as $meeting){
            //SOFT DELETE the meeting and associated attendances
            foreach($meeting->attendances as $attendance){
                $attendance->delete();
            }
            $meeting->delete();
        }
    }
}
