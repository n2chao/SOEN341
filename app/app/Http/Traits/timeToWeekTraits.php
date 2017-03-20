<?php

namespace App\Http\Traits;

use DB;
use App\User;


trait timeToWeekTraits
{
	public function timeToWeek($currentWeek, $startTime){
		
		date_default_timezone_set("America/New_York");
		$meeting = $currentWeek;
		
		while(date("l h A", $meeting) != $startTime){
			$meeting = strtotime("+1 hour", $meeting);

		}

		return $meeting;

	}

}