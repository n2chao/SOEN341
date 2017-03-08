<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Http\Traits\MeetingTraits;
use \App\Http\Traits\timeToWeekTraits;

class MeetingController extends Controller
{
    use MeetingTraits;
    use timeToWeekTraits;
    /**
    * Create a new meeting
    * Responds to POST /instructorMeeting
    */
    public function store(Request $request){
        $data = clone($request);
        $meetingTime = $this->timeToWeek($data->currentWeek, $data->start_time);
        //arbitraty test values
        $data->course_id = 1;
        $start = new \DateTime();
        $start->setTimestamp($meetingTime);
        $end = new \DateTime();
        $end->setTimestamp(strtotime("+1 hour", $meetingTime));

        $data->meetingStart = $start;
        $data->meetingEnd = $end;
        $data->instructorMeeting = true;

        //createMeeting() defined in MeetingTraits
        $this->createMeeting($data);
        return redirect('home');
    }

    /**
    * Show the details for specified meeting
    * Responds to GET /meetings/{id}
    */
    public function show(\App\Meeting $meeting){
        return $meeting;
    }

    /**
    * Delete a meeting and attendances.
    * Responds to DELETE /meetings/{id}
    */
    public function destroy(\App\Meeting $meeting){
        //leaveMeeting() defined in MeetingTraits
        $this->leaveMeeting($meeting);
        return redirect('home');
    }
}
