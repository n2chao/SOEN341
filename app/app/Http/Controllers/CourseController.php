<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    
    /*
    * Responds to GET /allCourses
    */
    public function index()
    {
        return \App\Course::all();     
    }
    
    /*
    * Responds to GET /courses
    */
//    public function show(Course $course){
//        return $course;
//    }
    
    /*
    * Responds to GET /courses/{course}
    */
    public function show(Course $course)
    {
        return $course;
    }
    
//    public function enrolled() {
//        
//    }
}
