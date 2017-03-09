<?php

namespace App\Http\Traits;

use DB;
use App\User;


trait timeToWeekTraits
{
	public function timeToWeek($currentWeek, $startTime){
		
		
		$meeting = $currentWeek;


		
		while(date("l h A", $meeting) != $startTime){
			$meeting = strtotime("+1 hour", $meeting);

		}
		return $meeting;

	}

}