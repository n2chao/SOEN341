<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait matchTraits
{
    public function match($userSchedule, $instrSchedule)
    {
        // $matchTime = [];
        // for($i = 0; $i < strlen($schedule1); $i++){
        //     if($schedule1[$i] == 1 && $schedule2[$i] == 1){
        //         $matchTime[$i] = 1;
        //     }
        //     else{
        //         $matchTime[$i] = 0;
        //     }
        // }
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
        return $matchTime;
    }
}