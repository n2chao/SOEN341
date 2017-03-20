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
        $userCourses = Auth::user()->enrollments->pluck('course_id');
        dd($userCourses);

        @foreach ($courses as $course) {
            $teachers = Enrollments::where('course_id' '=' $course);

            $tas = User::where('title', '=', 'ta')->pluck('id', 'name');
        }
        

        return view('instructors/chooseinstr', compact('teachers', 'tas'));
        
    	
    }

}
