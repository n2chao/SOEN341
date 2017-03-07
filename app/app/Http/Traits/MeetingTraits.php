<?php namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait MeetingTraits
{    
//    create student-student meeting request
//    private function createRequest($data){    
//    }
    
//    accept student-student meeting request
//    private function acceptRequest($data){
//    }
    
//    decline student-student meeting request
//    private function declineRequest($data){ 
//    }
    
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