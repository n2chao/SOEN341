<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CloseExpiredMeetingRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'requests:closeExpired';

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
     * Close all expired meeting requests.
     *      Delete all existing invites.
     *      Delete the meeting request.
     */
    public function handle()
    {
        $now = new \DateTime();
        date_default_timezone_set("America/New_York");
        // $this->info(var_dump($now));     output to console
        //get collection of all expired requests
        $openRequests = \App\Request::where('end_time', '<', $now)->get();
        foreach($openRequests as $request){
            //get and delete all invites for the respective meeting request
            foreach($request->invites as $invite){
                $invite->delete();
            }
            $request->delete();
        }
    }
}
