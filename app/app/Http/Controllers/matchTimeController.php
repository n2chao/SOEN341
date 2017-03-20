<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\matchTraits;
use App\Http\Traits\weekTraits;
use App\Http\Traits\truncateTraits;
use App\Http\Traits\stringToDatesTraits;
use App\Http\Traits\bookedTimeTraits;



class matchTimeController extends Controller
{
	use matchTraits;
	use weekTraits;
    use truncateTraits;
    use stringToDatesTraits;
    use bookedTimeTraits;

    public function create()
    {
        $this->validate(request(), [
            'instructor' => 'required'

            ]);
        date_default_timezone_set("America/New_York");
        $userSchedule = Auth::user()->schedule->freetime;  //get authenticated user
        $userMeetings = Auth::user()->meetings->pluck('start_time');

        $instructor = User::find(request('instructor'));
        $instrSchedule = $instructor->schedule->freetime;
        $instrMeetings = $instructor->meetings->pluck('start_time');
        
;        
        $week = $this->week();
       
        $availMatch = $this->match($userSchedule, $instrSchedule);
        

        $userBooked = $this->booked($week, $userMeetings);
        $instrBooked = $this->booked($week, $instrMeetings);
        

        $allBooked = $this->match($instrBooked, $userBooked);
        


        $allBooked = implode($allBooked);
        $availMatch = implode($availMatch);

        $trueWeekAvail = $this->match($allBooked, $availMatch);

        $finalMatch = $this->truncate($trueWeekAvail, $week[0]);

        
        return view('instructors/choosetime', compact('finalMatch', 'week', 'instructor'));
        
       
    }
}
