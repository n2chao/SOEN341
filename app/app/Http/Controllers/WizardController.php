<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Schedule;
use \App\Http\Traits\ScheduleTraits;
use \App\Http\Traits\EnrollTraits;

class WizardController extends Controller
{

  use ScheduleTraits;
  use EnrollTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return redirect( 'wizard/title' );
    }

    /**
     * Show the form for creating a title.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_title()
    {
      return view( 'wizard.title');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_title(Request $request)
    {
        $this->validate($request, [
          'title' => 'bail|required'
        ]);

        $user = Auth::user();
        $user->title = $request->title;
        $user->setup = true;
        $user->save();
        return redirect('home');
    }

}
