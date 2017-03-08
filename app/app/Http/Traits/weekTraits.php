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
				$week = array(strtotime("today"), strtotime("today +11 hours"));
			}
			else
			{
				$week = array(strtotime("tomorrow"), strtotime("next Saturday +11 hours"));
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
				$num = $num*24;
			
				$week = array(strtotime("+$num hours", $oldWeek[0]), strtotime("+168 hours", $oldWeek[1]));
			}
			else
			{
				$week = array(strtotime("+168 hours", $oldWeek[0]), strtotime("+168 hours", $oldWeek[1]));
			}
			
		
		}

		else if(request('prevWeek') == "prevWeek")
		{
			if(strtotime("tomorrow") == $oldWeek[0])
			{
				$week = $oldWeek;
			}
			else if(strtotime("tomorrow") > strtotime("-168 hours", $oldWeekStart))
			{
				$week = array(strtotime("tomorrow"), strtotime("-168 hours", $oldWeek[1]));
			}
			else if(date("l", $oldWeek[0])=="Saturday")
			{
				$week = $oldWeek;
			}
			else
			{
				$week = array(strtotime("-168 hours", $oldWeek[0]), strtotime("-168 hours", $oldWeek[1]));
			}
			
		}

		return $week;

	}
}