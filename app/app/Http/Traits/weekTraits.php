<?php

namespace App\Http\Traits;

use DB;
use App\User;
use Illuminate\Http\Request;


trait weekTraits
{
	public function week()
	{
		$oldWeekStart = request('weekStart');
		$oldWeekEnd = request('weekEnd');
		$oldWeek = array($oldWeekStart, $oldWeekEnd);

		date_default_timezone_set("America/New_York");

		if(request('nextWeek')== null && request('prevWeek') == null)
		{
			if(date("l")=="Saturday")
			{
				$week = array(strtotime("today"), strtotime("today"));
			}
			else
			{
				$week = array(strtotime("today"), strtotime("next Saturday"));
			}
        	
		}
		else if(request('nextWeek') == "nextWeek")
		{
			if(date("l", $oldWeek[0])!="Sunday")
			{
				$num = 0;
				$day = date("l", $oldWeek[0]);

				switch ($day) {
					
					case 'Monday':
						$num=6;
						break;
					case 'Tuesday':
						$num=5;
						break;
					case 'Wednesday':
						$num=4;
						break;
					case 'Thursday':
						$num=3;
						break;
					case 'Friday':
						$num=2;
						break;
					case 'Saturday':
						$num=1;
						break;
					default:
						break;
				}
			
				$week = array(strtotime("+$num days", $oldWeek[0]), strtotime("+7 days", $oldWeek[1]));
			}
			else
			{
				$week = array(strtotime("+7 days", $oldWeek[0]), strtotime("+7 days", $oldWeek[1]));
			}
			
		
		}
		else if(request('prevWeek') == "prevWeek")
		{
			if(strtotime("today") == $oldWeek[0]){
				return $oldWeek;
			}
			if(date("l", $oldWeek[0])=="Saturday")
			{
				$week = array(strtotime("-6 days", $oldWeek[0]), $oldWeek[1]);
			}
			else
			{
				$week = array(strtotime("last Sunday", $oldWeek[0]), strtotime("last Saturday", $oldWeek[1]));
			}
			
		}

		return $week;

	}
}