<?php

namespace App\Http\Traits;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait stringToDatesTraits
{
    public function stringToDates($matches)
    {
        $availMatch = array();
        $weekDay = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"); //day enums
        $weekHour = array("12 AM", "01 AM", "02 AM", "03 AM", "04 AM", "05 AM", "06 AM", "07 AM", "08 AM", "09 AM", "10 AM", "11 AM", "12 PM", "01 PM", "02 PM", "03 PM", "04 PM", "05 PM", "06 PM", "07 PM", "08 PM", "09 PM", "10 PM", "11 PM"); //time enums

        for($i = 0; $i < 168; $i++)
        {
            if($matches[$i] == 1)
            {
                //divide, modulous the position number of each "1" in matchTime to calculate Day and Time from the enums for displaying.
                $availMatch[$i] = $weekDay[$i/24] . " " . $weekHour[$i % 24];
            }
        }
        //error when $availMatch is not defined
        //returns arbitrary date when $availMatch is undefined
        
        return $availMatch;
    }
}
