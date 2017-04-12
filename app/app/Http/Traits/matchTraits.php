<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\bookedTimeTraits;
use App\Http\Traits\weekTraits;
use App\Http\Traits\truncateTraits;

trait matchTraits
{
    use bookedTimeTraits;
    use weekTraits;
    use truncateTraits;

    public function match($userA, $userB){
        $availMatch = $this->matchHelper($userA->schedule->freetime, $userB->schedule->freetime);
        //get the current week
        $week = $this->week();
        //get booked times for userA and userB
        $userABooked = $this->booked($week, $userA->meetings->pluck('start_time'));
        $userBBooked = $this->booked($week, $userB->meetings->pluck('start_time'));
        $allBooked = $this->matchHelper($userBBooked, $userABooked);
        $allBooked = implode($allBooked);
        $availMatch = implode($availMatch);
        $finalMatch = $this->matchHelper($allBooked, $availMatch);
        //truncate availabilities according to current week day
        return $this->truncate($finalMatch, $week[0]);
    }

    public function matchHelper($schedA, $schedB)
    {

        $matchTime = array();

        if(($schedA == null) && ($schedB == null)){
            for($i=0; $i < 168; $i++){
                $matchTime[$i] = 0;
            }
        }else if(($schedA == null && $schedB != null)){
            $matchTime = $schedB;
        }else if(($schedA != null && $schedB == null)){
            $matchTime = $schedA;
        }else{
           for($x = 0; $x < 168; ){ //itterates through each character in the bit string
                $bitA = substr($schedA, $x, 1); //inspects one bit of the users free time
                $bitB = substr($schedB, $x, 1); //inspects one bit of the instructors free time
                if(($bitA == 1) && ($bitB==1)){ //if they are both equal add to the "matchTime" bit string
                    $matchTime[$x] = 1;
                    $x++;
                }else{
                    $matchTime[$x] = 0;
                    $x++;
                }
            }
        }
        return $matchTime;
    }
}
