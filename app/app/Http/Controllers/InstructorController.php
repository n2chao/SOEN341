<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;


class InstructorController extends Controller
{/*
	function displays Instructor page to choose an instructor
	Passes teacher names and TA names to the view for display.

	*/
    public function index()
    {
    	$teachers = DB::table('users')->where('title', '=', 'teacher')->pluck('name');

    	$tas = DB::table('users')->where('title', '=', 'ta')->pluck('name');
    
    	return view('instructors/chooseinstr', compact('teachers', 'tas'));
    }
    public function show()

    {
    	$instrname = request('instructor');
  		$email = DB::table('users')->where('name', '=', $instrname)->value('email');
		return view('instructors/choosetime', compact('email'));
    }
   
}
