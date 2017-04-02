<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Schedule;
use App\Enrollment;

class Wizard
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
      if( Auth::user()->setup == false) {
        return redirect('wizard');
      }
        return $next($request);
    }
}
