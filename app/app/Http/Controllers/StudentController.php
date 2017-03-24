<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Get all enrolled courses for a given user.
     **/
    public function index()
    {
        $courses = Auth::user()->courses;
        return view('students/choosecourse', compact('courses'));
    }
}
