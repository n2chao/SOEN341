<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{

    /*
	   function displays Instructor page to choose an instructor
	   Passes teacher names and TA names to the view for display.
    */
    public function index()
    {
        $courses = Auth::user()->courses;
        $teachers = collect();  //create empty collection
        foreach($courses as $course){
            $teachers = $teachers->merge($course->users->where('title', '=', 'teacher')->pluck('id', 'name'));
        }
        $tas = collect();       //create empty collection
        foreach($courses as $course){
            $tas = $tas->merge($course->users->where('title', '=', 'ta')->pluck('id', 'name'));
        }
        return view('instructors/chooseinstr', compact('teachers', 'tas'));
    }
}
