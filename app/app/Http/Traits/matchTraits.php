<?php

namespace App\Http\Traits;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait matchTraits
{
    public function match($userSchedule, $instrSchedule)
    {
        for($x = 0; $x < 168; ) //itterates through each character in the bit string
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

        for($i = 0; $i < 168; $i++)
        {
            if($matchTime[$i] == 1)
            {
                //divide, modulous the position number of each "1" in matchTime to calculate Day and Time from the enums for displaying.
                $availMatch[$i] = $weekDay[$i/24] . " " . $weekHour[$i % 24]; 
            }
        }

        return $availMatch;
    }
}

