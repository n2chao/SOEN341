<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Http\Traits\MeetingTraits;

class HomeController extends Controller
{
    use MeetingTraits;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        //pass user's meetings and meeting requests to home view
        $meetings = $user->meetings;
        $requests = $user->requests;
        return view('home', compact('meetings', 'requests'));
    }
}
