<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;

//getting current user authentication.
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{   

    /*
	   function displays Instructor page to choose an instructor
	   Passes teacher names and TA names to the view for display.
    */
    public function index()
    {
        $user = Auth::user(); //Get current user

    	$teachers = User::where('title', '=', 'teacher')->pluck('name');

    	$tas = User::where('title', '=', 'ta')->pluck('name');
    
    	return view('instructors/chooseinstr', compact('teachers', 'tas'));
    }

    /*
        Displays free time matching with the student
        and/or free time in given hours
    */
    public function show()

    {

       
    }

    public function meeting()
    {

    }
   
}
