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
        //avoid hardcoding values
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
        $weekHour = array("12 AM", "01 AM", "02 AM", "03 AM", "04 AM", "05 AM", "06 AM", "07 AM", "08 AM", "09 AM", "10 AM", "11 AM", "12 PM", "01 PM", "02 PM", "03 PM", "04 PM", "05 PM", "06 PM", "07 PM", "08 PM", "09 PM", "10 PM", "11 PM"); //time enums

        for($i = 0; $i < 168; $i++)
        {
            if($matchTime[$i] == 1)
            {
                //divide, modulous the position number of each "1" in matchTime to calculate Day and Time from the enums for displaying.
                $availMatch[$i] = $weekDay[$i/24] . " " . $weekHour[$i % 24];
            }
        }
        //error when $availMatch is not defined
        //returns arbitrary date when $availMatch is undefined
        if(!isset($availMatch)){
          $availMatch[0] = 0 . " " . 0;
        }
        return $availMatch;
    }
}
