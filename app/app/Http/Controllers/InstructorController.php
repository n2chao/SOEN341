<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;

//getting current user authentication.
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{   

    /*
	   function displays Instructor page to choose an instructor
	   Passes teacher names and TA names to the view for display.
    */
    public function index()
    {
        $user = Auth::user(); //Get current user

    	$teachers = User::where('title', '=', 'teacher')->pluck('name');

    	$tas = User::where('title', '=', 'ta')->pluck('name');
    
    	return view('instructors/chooseinstr', compact('teachers', 'tas'));
    }

    /*
        Displays free time matching with the student
        and/or free time in given hours
    */
    public function show()

    {
        $user = Auth::user(); //Get current user
        $userSchedule = $user->schedule->freetime;
        
    	$instrSchedule =  User::where('name', '=', request('instructor'))->first()->schedule->freetime; //getting the instructors free time
        

        $availMatch = array(); //Used to send Strings of Days and Times to choosetime.blade.php page.
        
        
        $matchTime = array(); //new bit String to be constructed with matching times

        $strlen = strlen($userSchedule);
        for($x = 0; $x < $strlen; ) //itterates through each character in the bit string
        {
            $userBit = substr($userSchedule, $x, 1); //inspects one bit of the users free time
            $instrBit = substr($instrSchedule, $x, 1); //inspects one bit of the instructors free time

            if(($userBit == 1) && ($instrBit==1)) //if they are both equal add to the "matchTime" bit string
            {
                $matchTime[$x] = 1;
                $x++;
            }
            else
            {
                $matchTime[$x] = 0;
                $x++;
            }
        }
        
        $weekDay = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"); //day enums
        $weekHour = array("12 am", "1 am", "2 am", "3 am", "4 am", "5 am", "6 am", "7 am", "8 am", "9 am", "10 am", "11 am", "12 pm", "1 pm", "2 pm", "3 pm", "4 pm", "5 pm", "6 pm", "7 pm", "8 pm", "9 pm", "10 pm", "11 pm"); //time enums

        for($i = 0; $i < $strlen; $i++)
        {
            if($matchTime[$i] == 1)
            {
                //divide, modulous the position number of each "1" in matchTime to calculate Day and Time from the enums for displaying.
                $availMatch[$i] = $weekDay[$i/24] . " " . $weekHour[$i % 24]; 
            }
        }

        
		return view('instructors/choosetime', compact('availMatch'));
    }
   
}
