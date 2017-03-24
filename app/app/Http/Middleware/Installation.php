<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Schedule;
use App\Enrollment;

class Installation
{
    /**
     * Initial web installation
     * Forces authenticated users to have courses and schedules
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      // $enrollments= Enrollment::where( 'user_id', Auth::id() )->oldest()->first();
      // if( !isset($enrollments) ) {
      //   return redirect('courses/course');
      // }
      //
      // $schedule = Schedule::where( 'user_id', Auth::id() )->oldest()->first();
      // if( !isset($schedule) ) {
      //   return redirect('schedule/create');
      // }

      $user = User::find(Auth::id());

      if($user->setup == true) {
        return redirect('setup');
      }
        return $next($request);
    }
}
