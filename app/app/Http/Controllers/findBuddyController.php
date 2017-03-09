<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class findBuddyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $courses = array('MATH203', 'SOEN341', 'ELEC273');
      return view( 'findBuddy.courseDisplay', compact('courses') );//courses variable passed to view
    }
}
