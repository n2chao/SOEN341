<?php

namespace App\Http\Traits;

use DB;
use App\User;
use Illuminate\Http\Request;


trait truncateTraits
{
	public function truncate($schedule, $week)
	{	$num;
		$truncatedMatches;

		if($week == strtotime("tomorrow")){
			$today = date( "l", strtotime("today"));
			switch ($today) {
				case 'Monday':
					$num=2;
					break;
				case 'Tuesday':
					$num=3;
					break;
				case 'Wednesday':
					$num=4;
					break;
				case 'Thursday':
					$num=5;
					break;
				case 'Friday':
					$num=6;
					break;
				case 'Saturday':
					$num=6;
					break;
				default:
					$num=0;
					break;
				}
			}else{
				$num=0;
			}
		$num = $num*24;


		$j=0;
		for($i=0; $i<$num; $i++){
			$truncatedMatches[$i] = 0;
			$j=$i;
		}

		for($x = $j; $x < 168; ) //itterates through each character in the bit string
        {

            if($schedule[$x] == 1) //if they are both equal add to the "matchTime" bit string
            {
                $truncatedMatches[$x] = 1;
                $x++;
            }
            else
            {
                $truncatedMatches[$x] = 0;
                $x++;
            }
        }
        $matches = $this->stringToDates($truncatedMatches);


        return $matches;

	}
}
