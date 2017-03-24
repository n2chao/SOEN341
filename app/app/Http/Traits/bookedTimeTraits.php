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
        date_default_timezone_set("America/New_York");
        $meetingDay = array();
        $meetingHour = array();
        $meetingArray = array();
        $startDay = $week[0];
        $meetingString = null;


        //Convert timestamp back to unix time for comparison
        $c=0;
        foreach($userBooked as $booked){
            $userBooked[$c] = strtotime($booked);
            $c++;
        }


        if($userBooked == null){
            for($j=0; $j<168; $j++ ){
                $meetingArray[$j] = 0;
            }
            $meetingString = implode($meetingArray);

            return $meetingString;
        }else{
            $i = 0;

            while($startDay <  $week[1]){
                foreach($userBooked as $booked) {
                    if($startDay == $booked){
                        $meetingDay[$i] =  date("w", $booked); //weekday number
                        $meetingHour[$i] = date("H", $booked); //Hour in the day
                        $i++;
                    }
                }
                $startDay = date(strtotime("+1 hour", $startDay));
            }

        

            
            for($j=0; $j<168; $j++ ){
                $meetingArray[$j] = 1;
            }

            $meetingsLength = count($meetingDay);
            for($z=0; $z<168; $z++){
                for($k=0; $k<$meetingsLength; $k++){
                    if((($meetingDay[$k]*24)+$meetingHour[$k]) == $z){
                        $meetingArray[$z] = "0";
                    }
                }
            }
            

            
            $meetingsString = implode($meetingArray);
            
            
            return $meetingsString;
        }
    }
    
}

