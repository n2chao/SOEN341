<?php

namespace App\Http\Traits;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait bookedTimeTraits
{
    public function booked($week, $userBooked)
    {
        
        $meetingDay = array();
        $meetingHour = array();
        $meetingArray = array();
        $startDay = $week[0];
        $meetingString = null;

        if($userBooked == null){
            for($j=0; $j<168; $j++ ){
                $meetingArray[$j] = 0;
            }
            $meetingString = implode($meetingArray);
            return $meetingString;
        }else{
            $i = 0;
            while(date("F-l-H", $startDay) != date("F-l-H", $week[1])){
                @foreach($userBooked as $booked) {
                    if(date("F-l-H", $week[0]) == date("F-l-H", $booked)){
                        $meetingDay[$i] =  date("w", $booked);
                        $meetingHour[$i] = date("H", $booked);
                        $i++;
                    }
                }
                @endforeach
                $startDay = date("+1 hour", $startDay);
            }

            $meetingsLength = count($meetingDay);
            for($j=0; $j<168; $j++ ){
                for($k=0; $k<$meetingsLength; $k++){
                    if((($meetingDay[$k]*24)+$meetingHour[$k]) == $j){
                        $meetingArray[$j] = "1";
                    }else{
                        $meetingArray[$j] = "0";
                    }
                }
            }
            $meetingsString = implode($meetingArray);

            return $meetingString;
        }
    }
    
}

