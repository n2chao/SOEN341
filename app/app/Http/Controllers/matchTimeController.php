<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\matchTraits;
use App\Http\Traits\weekTraits;
use App\Http\Traits\stringToDatesTraits;

class matchTimeController extends Controller
{
	//since weekTraits is used in matchTraits, and matchTraits
	//is used in controller, collision for method 'week' must be resolved
	use weekTraits, matchTraits {
        weekTraits::week insteadof matchTraits;
    }
    use stringToDatesTraits;

    public function create()
    {
        $this->validate(request(), [
            'instructor' => 'required'

            ]);
        date_default_timezone_set("America/New_York");
        $user = Auth::user();
        $instructor = User::find(request('instructor'));
        $week = $this->week();
		$finalMatch = $this->match($user, $instructor);
        return view('instructors/choosetime', compact('finalMatch', 'week', 'instructor'));
    }
}
