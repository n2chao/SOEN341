<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Auth;
use App\Schedule;

trait ScheduleTraits
{
    public function schedule_store($request)
    {
      $this->validate($request, [
        'freetime' => 'bail|required'
      ]);

      $schedule = new Schedule();
      $schedule->user_id = Auth::id();
      $schedule->freetime = $this->to_freetime($request);
      $schedule->save();

    }

    public function to_freetime(Request $request)
    {
      $freetime = "";
      for ($day=0; $day < 7; $day++) {
        for ($hour=0; $hour < 24; $hour++) {
          $matched = false;
          $value = (string)$day.(string)$hour;
          for ($slot=0; $slot < count($request->freetime); $slot++) {
            if( strcmp( $value, $request->freetime[$slot] ) == 0 ) {
              $matched = true;
              break;
            }
          }
          if($matched) {
            $freetime .= "1";
          } else {
            $freetime .= "0";
          }
        }
      }
      return $freetime;
    }

}
