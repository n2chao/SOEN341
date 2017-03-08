<?php namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait MeetingTraits
{
    /**
     * Creates a new meeting request.
     * @param  $data array containing relevant meeting request information.
     */
     private function createMeetingRequest($data){
        $user = Auth::user();    //get authenticated user
        $request = new \App\Request();
        $request->course_id = $data->course_id;
        // $request->instructorMeeting = false; assumed to be studentMeeting
        $request->start_time = $data->meetingStart;
        $request->end_time = $data->meetingEnd;
        $request->save();
        //attach authenticated user and other student to the request
        $request->users()->attach($user);
        $request->users()->attach($data->student);
   }

    /**
    * Confirms meeting request, creates a new meeting and deletes the request, and invites.
    * Meeting requests can only be confirmed by the user receiving the request.
    * Hence, the sender cannot confirm the request.
    * @param  $request the meeting request
    */
    private function acceptMeetingRequest(\App\Request $request){
        $user = Auth::user();
        //if user is the receiver of the meeting request
        //is() method compares primary keys of two objects being compared
        if($request->receiver->is($user)){
            //create the new meeting
            //HERE
            //review createMeetings() method, make it more abstract by removing
            //the instructor? How to?
        }
    }

    /**
     * Declines the meeting request, effectively deleting the request and the invites.
     * Both the sender and receiver of the request can decline.
     * @param  $request the meeting request
     */
    private function declineMeetingRequest(\App\Request $request){

    }

    //create a new meeting
    //$data array holds relevant fields and two users
    private function createMeeting($data)
    {
        $user = Auth::user();  //get authenticated user
        $meeting = new \App\Meeting();
        $meeting->course_id = $data->course_id;
        $meeting->instructorMeeting = $data->instructorMeeting;
        $meeting->start_time = $data->meetingStart;
        $meeting->end_time = $data->meetingEnd;
        $meeting->save();
        //attach authenticated user and professor to the meeting
        $meeting->users()->attach($user);
        $meeting->users()->attach($data->instructor);
    }

    /**
    * Leave the meeting.
    * Because max size of meeting is 2 people,
    * the meeting and all attendances are canceled
    * once an attendant leaves.
    */
    private function leaveMeeting(\App\Meeting $meeting){
        $user = Auth::user();
        //if user is attending meeting, delete meeting and attendances
        if($meeting->users->contains($user)){
            foreach($meeting->attendances as $attendance){
                $attendance->delete();
            }
            $meeting->delete();
        }
    }
}
