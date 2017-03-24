<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Http\Traits\MeetingTraits;
use App\Http\Traits\matchTraits;
use App\Http\Traits\weekTraits;
use App\Http\Traits\truncateTraits;
use App\Http\Traits\stringToDatesTraits;
use App\Http\Traits\timeToWeekTraits;

class RequestController extends Controller
{
    use MeetingTraits;
    use matchTraits;
    use weekTraits;
    use truncateTraits;
    use stringToDatesTraits;
    use timeToWeekTraits;

    /**
     * Create a new meeting request.
     * Note that meeting requests are only created and sent
     * for student-student meetings.
     * @param $request the POST request
     */
     public function store(Request $request){
         $this->validate(request(), [
             'time' => 'required'
             ]);
        $data = clone($request);
        //array is serialized in client
        //serialization allows an array to be passed as value
        //ALTERNATIVE
        //Any better way to associate selected time with corresponding student->id?
        $student_time_array = unserialize($data->time);
        $meetingTime = $this->timeToWeek($data->currentWeek, $student_time_array[0]);
        //set start and end time for meeting request
        $start = new \DateTime();
        $start->setTimestamp($meetingTime);
        $end = new \DateTime();
        $end->setTimestamp(strtotime("+1 hour", $meetingTime));
        $data->start_time = $start;
        $data->end_time = $end;
        //add the student to $data
        $data->student = \App\User::find($student_time_array[1]);
        //createMeetingRequest() defined in MeetingTraits
        $this->createMeetingRequest($data);
        return redirect('home');
    }

    /**
    * Return the form containing matched students for the selected course.
    * @param  $request the GET request
    */
    public function create(Request $request){
        $this->validate(request(), [
            'course' => 'required'
            ]);
        $user = Auth::user();                           //get authenticated user
        $course = \App\Course::find($request->course);  //get selected course
        $students = $course->users->where('title', 'student')->except($user->id);  //get all classmates
        $matches = [];          //array of matching times corresponding to each student
        $week = $this->week();
        foreach($students as $student){
            //get available matches for authenticated user and student
            $availMatch = $this->match($user->schedule->freetime, $student->schedule->freetime);
            $truncatedMatch = $this->truncate($availMatch, $week[0]);
            if(count($truncatedMatch) > 0){                         //if at least one match
                $matches[(string)$student->id] = $truncatedMatch;   //add to matches
            }
            else{
                $students = $students->except($student->id);                    //remove student from collection
            }
        }
        return view('students/choosestudenttime', compact('students', 'matches', 'week', 'course'));
    }

    /**
     * Show details for a given meeting request.
     * @param  $request Meeting request object
     */
     public function show(\App\Request $request)
     {
        return $request;
    }

    /**
     * Decline a meeting request.
     * This deletes the meeting request and all associated invites,
     * @param $request Meeting request object
     */
     public function destroy(\App\Request $request)
     {
        //declineMeetingRequest defined in MeetingTraits
        $this->declineMeetingRequest($request);
        return redirect('home');
    }

    /**
    * Accept a meeting request.
    * @param $request Meeting request object
    */
    public function accept(\App\Request $request)
    {
        //acceptMeetingRequest defined in MeetingTraits
        $this->acceptMeetingRequest($request);
        return redirect('home');
    }
}
